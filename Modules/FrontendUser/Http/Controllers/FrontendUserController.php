<?php

namespace Modules\FrontendUser\Http\Controllers;

use App\Models\Image;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\SystemCore\Entities\Bolg;
use Modules\SystemCore\Entities\Gallery;
use Modules\SystemCore\Entities\RoomCategories;
use Modules\SystemCore\Entities\SitePreference;
use Spatie\QueryBuilder\QueryBuilder;

class FrontendUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $room_categories = RoomCategories::all();
        $site_preferences = SitePreference::first();
        return view('frontenduser::index', compact('room_categories', 'site_preferences'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function about(): Renderable
    {
        $site_preferences = SitePreference::first();
        return view('frontenduser::about', compact('site_preferences'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function accomodation(): Renderable
    {
        $room_categories = QueryBuilder::for(RoomCategories::class)
            ->allowedFilters(['name', 'charge_per_day'])
            ->allowedSorts(['created_at'])
            ->get();
        return view('frontenduser::accomodation', compact('room_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function acomodationSingle($slug): Renderable
    {
        $accomodation = QueryBuilder::for(RoomCategories::class)
            ->where('slug', $slug)
            ->with('images')
            ->with('roomCategoryFeatures')
            ->first();
        return view('frontenduser::accomodation-single', compact('accomodation'));
    }

    public function bookAccomodation($slug)
    {
        //Todo need to check availability of room_category
        $accomodation = QueryBuilder::for(RoomCategories::class)
            ->where('slug', $slug)
            ->with('roomCategoryFeatures')
            ->first();
        if ($accomodation->no_of_rooms > 0) {
            return view('frontenduser::book-accomodation', compact('accomodation'));
        } else {
            return redirect()->back()->with('error', 'No room_category available');
        }
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function gallery(): Renderable
    {
        $images = QueryBuilder::for(Image::class)
            ->where('imageable_type', Gallery::class)
            ->get();
        return view('frontenduser::gallery', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function contact(): Renderable
    {
        $site_preferences = SitePreference::first();
        return view('frontenduser::contact', compact('site_preferences'));
    }

    public function blog()
    {
        $blogs = QueryBuilder::for(Bolg::class)
            ->where('is_published', 1)
            ->with('user')
            ->with('images')
            ->get();
        return view('frontenduser::blog.blog', compact('blogs'));
    }

    public function blogSingle($slug)
    {
        $blog = QueryBuilder::for(Bolg::class)
            ->where('slug', $slug)
            ->where('is_published', 1)
            ->with('user')
            ->with('images')
            ->first();

        if ($blog) {
            return view('frontenduser::blog.blog-single', compact('blog'));
        } else {
            return redirect()->back()->with('error', 'Blog not found');
        }
    }


}
