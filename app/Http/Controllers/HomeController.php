<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ItemList;
use App\Models\Image;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard2');
    }

    public function profile($id)
    {
        $user = User::find($id);
        $posts = ItemList::where('id_owner', $user->id)->paginate(6);
        $profilePicture = Image::where('id_post', $id)->first();

        $data = [
            'category_name' => 'users',
            'page_name' => 'profile',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        return view('profiles.userProfile', compact('user', 'posts'))->with($data);
    }

    public function editProfile($id)
    {
        $user = User::find($id);
        $profilePicture = Image::where('id_post', $id)->first();

        $data = [
            'category_name' => 'users',
            'page_name' => 'account_settings',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        return view('pages.users.user_account_setting', compact('user'))->with($data);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('uploads', $fileName, 'public');
    
            // Delete the old image
            if ($user->image_path) {
                $oldImagePath = public_path($user->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image
                }
            }

            // Save the file path to the users table
            $validated['image_path'] = '/storage/uploads/' . $fileName;
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'image_path' => $validated['image_path'] ?? $user->image_path, // Retain old image if not updated
        ]);

        $data = [
            'category_name' => 'users',
            'page_name' => 'profile',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        return redirect('/');
    }
}
