<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $newPostId = session()->get('newPostId');

        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time().'_'.$image->getClientOriginalName();
                $filePath = $image->storeAs('uploads', $fileName, 'public');

                Image::create([
                    'file_path' => '/storage/app/public/uploads/' . $filePath,
                    'id_owner' => $request->id_owner,
                    'id_post' => $newPostId,
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


    public function index()
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'createPost',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        return view('posts.upload')->with($data);
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $fileName = time().'_'.$image->getClientOriginalName();
                $filePath = $image->storeAs('uploads', $fileName, 'public');

                Image::create([
                    'file_path' => '/storage/app/public/uploads/' . $filePath,
                    'id_owner' => $request->id,
                ]);
            }
        }

        $data = [
            'category_name' => 'users',
            'page_name' => 'account_settings',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return redirect('/posts/items/create')->with($data);
    }
}
