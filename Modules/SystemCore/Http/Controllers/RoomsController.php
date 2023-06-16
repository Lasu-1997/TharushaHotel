<?php

namespace Modules\SystemCore\Http\Controllers;

use App\Models\Image;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SystemCore\Entities\RoomCategories;
use Modules\SystemCore\Entities\RoomCategoryFeatures;
use Spatie\QueryBuilder\QueryBuilder;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $room_categories = QueryBuilder::for(RoomCategories::class)
            ->get();
        return view('systemcore::room_category.index', compact('room_categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:room_categories',
            'description' => 'required',
            'charge_per_day' => 'required',
            'no_of_adults' => 'required',
            'no_of_children' => 'required',
            'no_of_rooms' => 'required',
        ]);
        try {
            $room_category = new RoomCategories();
            $room_category->name = $request->name;
            $room_category->no_of_rooms = $request->no_of_rooms;
            $room_category->no_of_adults = $request->no_of_adults;
            $room_category->no_of_children = $request->no_of_children;
            $room_category->charge_per_day = $request->charge_per_day;
            $room_category->description = $request->description;
            $room_category->save();

            return redirect("room_category/$room_category->slug/images");
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function roomCategoryImages($slug): Factory|View|Application
    {
        $room_category = QueryBuilder::for(RoomCategories::class)
            ->where('slug', $slug)
            ->with('images')
            ->first();

        return view('systemcore::room_category.images', compact('room_category'));
    }

    public function roomCategoryUpdateImages(Request $request, $slug)
    {
        $room_category = QueryBuilder::for(RoomCategories::class)
            ->where('slug', $slug)
            ->with('images')
            ->first();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $key => $image) {
                $imageName = time() . $key . $room_category->name . '.' . $image->getClientOriginalExtension();
                $image_resize = \Intervention\Image\Facades\Image::make($image->getRealPath());
                $image_resize->fit(250);
                $image_resize->save(public_path('images/room_categories/' . $imageName));

                $room_category->images()->create([
                    'imageable_id' => $room_category->id,
                    'imageable_type' => RoomCategories::class,
                    'name' => $imageName,
                    'path' => 'images/room_categories/' . $imageName,
                ]);
            }
            return redirect('/room_category')->with('success', 'Room category created successfully');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('systemcore::room_category.create');
    }

    public function roomCategoryDeleteImage($id): RedirectResponse
    {
        $image = QueryBuilder::for(Image::class)->where('id', $id)->first();
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $slug
     * @return Renderable
     */
    public function edit($slug)
    {
        $room_category = QueryBuilder::for(RoomCategories::class)
            ->where('slug', $slug)
            ->first();
        return view('systemcore::room_category.update', compact('room_category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $slug)
    {
        $room_category = QueryBuilder::for(RoomCategories::class)
            ->where('slug', $slug)
            ->with('roomCategoryFeatures')
            ->first();

        $request->validate([
            'name' => 'required|unique:room_categories',
            'description' => 'required',
            'charge_per_day' => 'required',
            'no_of_adults' => 'required',
            'no_of_children' => 'required',
            'no_of_rooms' => 'required',
        ]);
        try {
            $room_category->name = $request->name;
            $room_category->no_of_rooms = $request->no_of_rooms;
            $room_category->no_of_adults = $request->no_of_adults;
            $room_category->no_of_children = $request->no_of_children;
            $room_category->charge_per_day = $request->charge_per_day;
            $room_category->description = $request->description;

            $room_category->save();

            return redirect()->back()->with('success', 'Room category updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function addRoomCategoryFeature(Request $request, $slug): RedirectResponse
    {
        $room_category = QueryBuilder::for(RoomCategories::class)
            ->where('slug', $slug)
            ->with('roomCategoryFeatures')
            ->first();
        $request->validate([
            'feature' => 'required',
        ]);
        try {
            $room_category->roomCategoryFeatures()->create([
                'feature' => $request->feature,
                'icon_keyword' => 'lnr ' . $request->icon_keyword
            ]);
            return redirect()->back()->with('success', 'Room category feature added successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteRoomCategoryFeature($id): RedirectResponse
    {
        $room_category_feature = QueryBuilder::for(RoomCategoryFeatures::class)
            ->where('id', $id)
            ->first();
        $room_category_feature->delete();
        return redirect()->back()->with('success', 'Room category feature deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $room_category = QueryBuilder::for(RoomCategories::class)
            ->where('id', $id)
            ->first();
        $room_category->images()->delete();
        $room_category->delete();
        return redirect()->back()->with('success', 'Room category deleted successfully');
    }
}
