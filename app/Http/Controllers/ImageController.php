<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time().'_'.$image->getClientOriginalName();
                $filePath = $image->storeAs('uploads', $fileName, 'public');

                Image::create(['file_path' => '/storage/app/public/uploads/' . $filePath,
                'id_owner' => $request->id_owner
            ]);
            }
        }

        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'createPost',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return redirect('/posts/items/create')->with($data);
    }
}
