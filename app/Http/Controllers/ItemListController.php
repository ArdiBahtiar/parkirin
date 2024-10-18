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
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'createPost',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        // $users = User::find($id); BISA DIAMBIL LANGSUNG PAKE Auth::user()
        return view('posts.createPost')->with($data);
    }


    public function store(Request $request)
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'createPost',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        ItemList::create($request->all());
        return redirect('/posts/items/create')->with($data);
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


    public function edit(ItemList $itemList, $id)
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'createPost',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $item = ItemList::find($id);
        return view('posts.editPost', compact('item'))->with($data);
    }


    public function update(Request $request, ItemList $itemList, $id)
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'createPost',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $itemList = ItemList::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'detail_info' => 'required|string',
            'ukuran' => 'required|string',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|url',
            'id_owner' => 'required|integer',
        ]);
        
        // $itemList->update($request->all());
        $itemList->update($validated);
        return redirect('/posts/items/create')->with($data);
    }


    public function destroy(ItemList $itemList)
    {
        //
    }
}
