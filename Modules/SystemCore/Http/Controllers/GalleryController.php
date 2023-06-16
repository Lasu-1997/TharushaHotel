<?php

namespace Modules\SystemCore\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SystemCore\Entities\Gallery;
use Spatie\QueryBuilder\QueryBuilder;

class GalleryController extends Controller
{
    public function editGallery()
    {
        $gallery_images = QueryBuilder::for(Image::class)
            ->where('imageable_type', 'Modules\SystemCore\Entities\Gallery')
            ->get();

        return view('systemcore::gallery.update', compact('gallery_images'));
    }

    public function updateGallery(Request $request)
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $key => $image) {
                $imageName = time() . $key . '.' . $image->getClientOriginalExtension();
                $image_resize = \Intervention\Image\Facades\Image::make($image->getRealPath());
                $image_resize->fit(250);
                $image_resize->save(public_path('images/gallery_images/' . $imageName));

                Image::create([
                    'imageable_id' => 1,
                    'imageable_type' => Gallery::class,
                    'name' => $imageName,
                    'path' => 'images/gallery_images/' . $imageName,
                ]);
            }
            return redirect('/gallery_images')->with('success', 'Gallery updated successfully');
        }
        return redirect('/gallery_images')->with('error', 'Image not found!');
    }

    public function deleteGalleryImage($id)
    {

        $image = QueryBuilder::for(Image::class)
            ->where('id', $id)
            ->first();
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }
}
