<?php

namespace Modules\SystemCore\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SystemCore\Entities\BookingHoldDate;
use Modules\SystemCore\Entities\Bookings;
use Modules\SystemCore\Entities\RoomCategories;
use Spatie\QueryBuilder\QueryBuilder;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $bookings = QueryBuilder::for(Bookings::class)
                ->allowedFilters(['id', 'name', 'email', 'phone', 'room_category_id', 'room_id', 'status'])
                ->allowedSorts(['created_at'])
                ->with('user', 'roomCategory')
                ->paginate(10);
        } else {
            $bookings = QueryBuilder::for(Bookings::class)
                ->allowedFilters(['id', 'name', 'email', 'phone', 'room_category_id', 'room_id', 'status'])
                ->where('guest_id', Auth::user()->id)
                ->allowedSorts(['created_at'])
                ->with('user', 'roomCategory')
                ->paginate(10);
        }

        return view('systemcore::booking.index', compact('bookings'));
    }

    public function viewBooking($id)
    {
        $booking = QueryBuilder::for(Bookings::class)
            ->with('roomCategory')
            ->with('user')
            ->where('id', $id)->first();

        return view('systemcore::booking.id', compact('booking'));
    }

    public function adminApprove($id)
    {
        if (Auth::user()->hasRole('admin')) {
            $booking = QueryBuilder::for(Bookings::class)
                ->where('id', $id)->first();
            $booking->status = 3;
            $booking->save();
        } else {
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function adminDecline($id)
    {
        if (Auth::user()->hasRole('admin')) {
            $booking = QueryBuilder::for(Bookings::class)
                ->where('id', $id)->first();
            $booking->status = 2;
            $booking->save();
        } else {
            return redirect()->back();
        }
        return redirect()->back();
    }


    /**
     * Store a newly created resource in storage.
     * @return Renderable
     */
    public function adminCreate(): Renderable
    {
        $room_categories = QueryBuilder::for(RoomCategories::class)
            ->get();
        return view('systemcore::booking.create', compact('room_categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function adminStore(Request $request): RedirectResponse
    {
        $request->validate([
            'guest_name' => 'required',
            'guest_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'id_type' => 'required',
            'id_number' => 'required',
            'room_category_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'no_of_adults' => 'required',
            'no_of_children' => 'required',
            'no_of_rooms' => 'required',
        ]);
        if ($request->has('guest_email')) {
            $request->validate([
                'guest_email' => 'email',
            ]);
        }
        if ($request->has('errors')) {
            return redirect()->back()->withErrors($request->errors);
        } else {
            if ($request->check_in < date('Y-m-d')) {
                return redirect()->back()->withErrors(['check_in' => 'Check in date must be greater than today']);
            } elseif ($request->check_out < date('Y-m-d')) {
                return redirect()->back()->withErrors(['check_out' => 'Check out date must be greater than today']);
            } elseif ($request->check_out < $request->check_in) {
                return redirect()->back()->withErrors(['check_out' => 'Check out date must be greater than check in date']);
            } else {
                //check_in and check_out should be date time format
                $check_in = date('Y-m-d H:i:s', strtotime($request->check_in));
                $check_out = date('Y-m-d H:i:s', strtotime($request->check_out));

                $booking = Bookings::create([
                    'guest_id'=>Auth::user()->id,
                    'guest_name' => $request->guest_name,
                    'guest_email' => $request->guest_email,
                    'guest_phone' => $request->guest_phone,
                    'id_type' => $request->id_type,
                    'id_number' => $request->id_number,
                    'room_category_id' => $request->room_category_id,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'no_of_adults' => $request->no_of_adults,
                    'no_of_children' => $request->no_of_children,
                    'no_of_rooms' => $request->no_of_rooms,
                    'status' => 1,
                ]);
                return redirect()->back()->with('success', 'Booking created successfully');
            }
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('systemcore::create');
    }


    public function userCreate(Request $request, $slug)
    {
        $request->validate([
            'guest_name' => 'required',
            'guest_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'id_type' => 'required',
            'id_number' => 'required',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date',
            'no_of_adults' => 'required|numeric|min:1',
            'no_of_children' => 'required|numeric|min:0',
        ]);
        $accomodation = RoomCategories::where('slug', $slug)->first();

        if ($accomodation) {
            if ($request->check_in < date('Y-m-d')) {
                return redirect()->back()->withErrors(['check_in' => 'Check in date must be greater than today']);
            } elseif ($request->check_out < date('Y-m-d')) {
                return redirect()->back()->withErrors(['check_out' => 'Check out date must be greater than today']);
            } elseif ($request->check_out < $request->check_in) {
                return redirect()->back()->withErrors(['check_out' => 'Check out date must be greater than check in date']);
            } else {
                $check_in = date('Y-m-d H:i:s', strtotime($request->check_in));
                $check_out = date('Y-m-d H:i:s', strtotime($request->check_out));

                $booking_hold_dates = QueryBuilder::for(BookingHoldDate::class)
                    ->get();

                foreach ($booking_hold_dates as $booking_hold_date) {
                    if ($check_in >= $booking_hold_date->start_date && $check_in <= $booking_hold_date->end_date) {
                        return view('frontenduser::book-accomodation', compact('accomodation'))
                            ->withErrors(['check_in' => 'We are sorry, the ' . $accomodation->name . ' are not available for the selected dates']);
                    }
                }

                $booking = Bookings::create([
                    'guest_name' => $request->guest_name,
                    'guest_id' => Auth::user()->id,
                    'guest_email' => $request->guest_email,
                    'guest_phone' => $request->guest_phone,
                    'id_type' => $request->id_type,
                    'id_number' => $request->id_number,
                    'room_category_id' => $accomodation->id,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'no_of_adults' => $request->no_of_adults,
                    'no_of_children' => $request->no_of_children,
                    'no_of_rooms' => $request->no_of_rooms,
                    'status' => 1,
                ]);

                if ($booking) {
//                    //send email to user
//                    $user = User::find($booking->user_id);
//                    $user->notify(new BookingCreated($booking));
//                    //send email to admin
//                    $admin = User::where('role', 'admin')->first();
//                    $admin->notify(new BookingCreated($booking));
//                    //return success message

                    if (Auth::user()->hasRole('admin')) {
                        $bookings = QueryBuilder::for(Bookings::class)
                            ->with('roomCategory', 'user')
                            ->paginate(10);
                    } else {
                        $bookings = QueryBuilder::for(Bookings::class)
                            ->where('guest_id', Auth::user()->id)
                            ->with('roomCategory', 'user')
                            ->paginate(10);
                    }
                    return redirect()->route('dashboard', compact('bookings'))
                        ->with('success', 'Booking created successfully');
                } else {
                    return redirect()->back()->with('error', 'Sorry,something went wrong');
                }
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Room category not found']);
        }

    }

    public function checkAvailability(Request $request)
    {
        $search_data = $request->all();

        $check_in = date('Y-m-d', strtotime($request->check_in));
        $check_out = date('Y-m-d', strtotime($request->check_out));

        $booking_hold_dates = QueryBuilder::for(BookingHoldDate::class)
            ->get();

        $room_categories = [];

        foreach ($booking_hold_dates as $booking_hold_date) {
            if ($check_in >= $booking_hold_date->start_date && $check_in <= $booking_hold_date->end_date) {
                return view('frontenduser::availability', compact('room_categories', 'search_data'));
            }
        }

        $room_categories = QueryBuilder::for(RoomCategories::class)
            ->allowedFilters(['name', 'price'])
            ->with('images')
            ->with('roomCategoryFeatures')
            ->get();

        return view('frontenduser::availability', compact('room_categories', 'search_data'));

    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return Renderable
     */
    public function adminHoldBookingsIndex()
    {
        $booking_hold_dates = QueryBuilder::for(BookingHoldDate::class)
            ->get();
        return view('systemcore::booking.hold.index', compact('booking_hold_dates'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return Renderable
     */
    public function adminHoldBookingsCreate()
    {
        return view('systemcore::booking.hold.create');
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return RedirectResponse
     */
    public function adminHoldBookingsStore(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));

        $booking_hold_date = BookingHoldDate::create([
            'start_date' => $start_date,
            'end_date' => $end_date,
            'description' => $request->description,
        ]);

        if ($booking_hold_date) {
            return redirect()->back()
                ->with('success', 'Booking hold date created successfully');
        } else {
            return redirect()->back()->with('error', 'Sorry,something went wrong');
        }
    }

    public function markAsPaid($id)
    {
        $booking = Bookings::find($id);
        if ($booking) {
            $booking->payment_status = 'paid';
            $booking->save();
            return redirect()->back()
                ->with('success', 'Booking marked as paid successfully');
        } else {
            return redirect()->back()->with('error', 'Sorry,something went wrong');
        }
    }

    public function destroyBookingHoldDate($id): RedirectResponse
    {
        BookingHoldDate::where('id', $id)->delete();
        return redirect()->back()
            ->with('success', 'Booking hold date removed successfully');
    }

}
