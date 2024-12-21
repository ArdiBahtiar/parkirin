<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ItemList;

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
        $data = [
            'category_name' => 'users',
            'page_name' => 'account_settings',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        return view('pages.users.user_account_setting',compact('user'))->with($data);
    }

    public function storeProfile()
    {
        // $user
    }
}
