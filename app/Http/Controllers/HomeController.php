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
        $users = User::find($id);
        $posts = ItemList::where('user_id', $users->id)->get();

        return view('profile.indexProfile', ['users' => $users, 'posts' => $posts]);
    }
}
