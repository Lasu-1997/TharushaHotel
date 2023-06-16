<?php

namespace Modules\SystemCore\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\SystemCore\Entities\Bookings;
use Modules\SystemCore\Entities\SitePreference;
use Spatie\QueryBuilder\QueryBuilder;

class SystemCoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
        $total_bookings_last_month=0;
        $users_count=0;
        $total_income_last_month=0;
        $unique_visitors=0;
        if (Auth::user()->hasRole('admin')) {
            $bookings = QueryBuilder::for(Bookings::class)
                ->allowedFilters(['id', 'name', 'email', 'phone', 'room_category_id', 'room_id', 'status'])
                ->allowedSorts(['created_at'])
                ->with('user', 'roomCategory')
                ->paginate(10);
            $total_bookings_last_month = QueryBuilder::for(Bookings::class)
                ->whereMonth('created_at', '=', date('m'))
                ->count();
            $users_count=QueryBuilder::for(User::class)
                ->count();
            $total_income_last_month = QueryBuilder::for(Bookings::class)
                ->whereMonth('created_at', '=', date('m') - 1)
                ->where('status', 3)
                ->sum('total_to_pay');
            $unique_visitors = DB::table('sessions')->count();

        } else {
            $bookings = QueryBuilder::for(Bookings::class)
                ->allowedFilters(['id', 'name', 'email', 'phone', 'room_category_id', 'room_id', 'status'])
                ->where('guest_id', Auth::user()->id)
                ->allowedSorts(['created_at'])
                ->with('user', 'roomCategory')
                ->paginate(10);
        }

        return view('dashboard', compact('bookings', 'total_bookings_last_month', 'users_count','total_income_last_month','unique_visitors'));
    }

    public function sitePreferences()
    {
        $site_preference = SitePreference::first();
        return view('systemcore::preferences.site_settings', compact('site_preference'));
    }

    public function updateSitePreferences(Request $request)
    {
        $site_preference = SitePreference::first();
        $site_preference->update($request->all());
        return redirect()->back()->with('success', 'Site preferences updated successfully');
    }
}
