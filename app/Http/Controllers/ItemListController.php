<?php

namespace App\Http\Controllers;

use App\Models\ItemList;
use App\Models\User;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;


class ItemListController extends Controller
{
    public function index(): View
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $posts = ItemList::paginate(6);
        return view('posts.index', compact('posts'))->with($data);
    }

    public function filter(Request $request)
    {
        $filterLokasi = $request->lokasi;
        $filterHarga = $request->harga;
        $filterTipe = $request->tipe_lahan;
        $filterUkuran = $request->ukuran_mobil;
        
        // $filterHarga = ItemList::all()->sortBy([
        //     ['harga', 'desc'],
        // ]);
    }


    public function create()
    {
        // $users = User::find($id); BISA DIAMBIL LANGSUNG PAKE Auth::user()
        return view('pages.createItem');
    }


    public function store(Request $request)
    {
        ItemList::create($request->all());
        return redirect('/items');
    }


    public function focus($id)
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $list = ItemList::find($id);
        $user = User::where('id', '=', $list->id_owner)->first();
        return view('posts.focus', ['list' => $list, 'user' => $user])->with($data);
    }


    public function edit(ItemList $itemList)
    {
        //
    }


    public function update(Request $request, ItemList $itemList)
    {
        //
    }


    public function destroy(ItemList $itemList)
    {
        //
    }
}
