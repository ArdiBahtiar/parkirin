<?php

namespace App\Http\Controllers;

use App\Models\ItemList;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
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
        $data = [
            'category_name' => 'posts',
            'page_name' => 'analytics',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $filterMinHarga = $request->input('minHarga');
        $filterMaxHarga = $request->input('maxHarga');
        $filterUkuran = $request->input('ukuran');

        $query = ItemList::query();

        if ($filterMinHarga) {
            $query->where('harga', '>=', $filterMinHarga);
        }
        
        if ($filterMaxHarga) {
            $query->where('harga', '<=', $filterMaxHarga);
        }

        if ($filterUkuran) {
            $query->where('ukuran', $filterUkuran);
        }

        $posts = $query->paginate(6);

        return view('posts.indexFilter', compact('posts'))->with($data);
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


        $item = ItemList::findOrFail($id);
        $isBookmarked = Auth::user()->bookmarkedPosts->contains($item->id);


        $list = ItemList::find($id);
        $user = User::where('id', '=', $list->id_owner)->first();
        $images = Image::where('id_post', $id)->get();
        return view('posts.focus', ['list' => $list, 'user' => $user,'images' => $images, 'item' => $item, 'isBookmarked' => $isBookmarked])->with($data);
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
        $productImages = Image::where('id_post', $id)->get();
        // $productImages = Image::where('id_post', $id)->first();
        return view('posts.editPost', compact('item', 'productImages'))->with($data);
    }


    public function update(Request $request, ItemList $itemList, $id)
    {
        $itemList = ItemList::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'detail_info' => 'required|string',
            'ukuran' => 'required|string',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'id_owner' => 'required|integer',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time().'_'.$image->getClientOriginalName();
                $filePath = $image->storeAs('uploads', $fileName, 'public');

                Image::create([
                    'file_path' => '/storage/uploads/' . $fileName,
                    'id_owner' => $itemList->id_owner,
                    'id_post' => $itemList->id
                ]);
            }
        }
        
        $data = [
            'category_name' => 'posts',
            'page_name' => 'createPost',    // ini udah tak bikin custom style dan script nya
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        // $itemList->update($request->all());
        $itemList->update($validated);
        return redirect('/posts/items/')->with($data);
    }


    public function destroy(int $id)
    {
        $image = Image::findOrfail($id);
        $filePath = str_replace('/storage', '', $image->file_path);

        if(Storage::disk('public')->exists($filePath))
        {
            Storage::disk('public')->delete($filePath);
        }
        $image->delete();

        $data = [
            'category_name' => 'posts',
            'page_name' => 'createPost',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        return redirect()->back()->with($data);
    }
}
