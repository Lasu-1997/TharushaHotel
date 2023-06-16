<?php

namespace Modules\SystemCore\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Modules\SystemCore\Entities\Bolg;
use Spatie\QueryBuilder\QueryBuilder;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $blog_posts =QueryBuilder::for(Bolg::class)
            ->with('user')
            ->get();
        return view('systemcore::blog.index', compact('blog_posts'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->is_published === "on") {
            $request->is_published = true;
        } else {
            $request->is_published = false;
        }

        $blog = new Bolg();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->is_published = $request->is_published;
        $blog->author_id = Auth::id();
        $blog->save();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $key => $image) {
                $imageName = time() . $key . $blog->title . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->fit(250);
                $image_resize->save(public_path('images/blog_images/' . $imageName));

                $blog->images()->create([
                    'imageable_id' => $blog->id,
                    'imageable_type' => Bolg::class,
                    'name' => $imageName,
                    'path' => 'images/blog_images/' . $imageName,
                ]);
            }
            return redirect()->back()->with('success', 'Post created successfully');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('systemcore::blog.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $blog_post = QueryBuilder::for(Bolg::class)
            ->where('id', $id)
            ->with('images')
            ->first();
        return view('systemcore::blog.update', compact('blog_post'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $blog = Bolg::find($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->is_published === "on") {
            $request->is_published = true;
        } else {
            $request->is_published = false;
        }

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->is_published = false;
        $blog->author_id = Auth::id();
        $blog->save();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $key => $image) {
                $imageName = time() . $key . $blog->title . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->fit(750, 350);
                $image_resize->save(public_path('images/blog_images/' . $imageName));

                $blog->images()->create([
                    'imageable_id' => $blog->id,
                    'imageable_type' => Bolg::class,
                    'name' => $imageName,
                    'path' => 'images/blog_images/' . $imageName,
                ]);
            }
            return redirect()->back()->with('success', 'Updated successfully');
        }
        return redirect()->back()->with('success', 'Updated successfully');
    }


    public function togglePublish($id)
    {
        $blog = Bolg::find($id);
        $blog->is_published = !$blog->is_published;
        $blog->save();
        return redirect()->back()->with('success', 'Updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $blog = Bolg::find($id);
        $blog->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

}
