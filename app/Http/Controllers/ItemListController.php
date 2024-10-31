<?php

namespace App\Http\Controllers;

use App\Models\ItemList;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;


class ItemListController extends Controller
{
    public function index(): View
    {
        $data = [
            'category_name' => 'posts',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $posts = ItemList::paginate(6);
        return view('posts.index', compact('posts'))->with($data);
    }

    public function search(Request $request)
    {
        $data = [
            'category_name' => 'posts',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $cari = $request->cari;
        $searchDatas = ItemList::where('nama', 'like', "%".$cari."%")->paginate(6);
        // dd($cari);
        return view('posts.indexSearch', ['posts' => $searchDatas])->with($data);
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
            'category_name' => 'posts',
            'page_name' => 'createPost',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        // $users = User::find($id); BISA DIAMBIL LANGSUNG PAKE Auth::user()
        return view('posts.createPost')->with($data);
    }


    public function store(Request $request)
    {
        $newPost = ItemList::create($request->all());
        
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time().'_'.$image->getClientOriginalName();
                $filePath = $image->storeAs('uploads', $fileName, 'public');

                Image::create([
                    'file_path' => '/storage/uploads/' . $fileName,
                    'id_owner' => $request->id_owner,
                    'id_post' => $newPost->id
                ]);
            }
        }
        
        $data = [
            'category_name' => 'posts',
            'page_name' => 'createPost',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        return redirect('/posts/items/create')->with($data);
    }


    public function focus($id)
    {
        $data = [
            'category_name' => 'posts',
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
            'category_name' => 'posts',
            'page_name' => 'createPost',    // ini udah tak bikin custom style dan script nya
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $item = ItemList::find($id);
        return view('posts.editPost', compact('item'))->with($data);
    }


    public function update(Request $request, ItemList $itemList, $id)
    {
        $data = [
            'category_name' => 'posts',
            'page_name' => 'createPost',    // ini udah tak bikin custom style dan script nya
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
