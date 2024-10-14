<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ItemList;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function save(ItemList $list)
    {
        $bookmark = Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'item_list_id' => $list->id,
        ]);

        return response()->json(['message' => 'Postingan Tersimpan', 'bookmark' => $bookmark], 201);
    }

    public function destroy(ItemList $list)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())->where('item_list_id', $list->id)->first();

        if($bookmark)
        {
            $bookmark->delete();
            return response()->json(['message' => 'Postingan tidak lagi disimpan'], 200);
        }

        return response()->json(['message' => 'Ngga ada Bookmark'], 404);
    }
 
    public function bookmarked()
    {
        // $bookmarks = Bookmark::where('user_id', '=', Auth::id())->paginate(6);
        // $post_ids = $bookmarks->pluck('post_id');
        // $items = ItemList::whereIn('id', $post_ids)->get();
        // return view('pages.bookmarked', ['bookmarks' => $bookmarks, 'items' => $items]);

        $bookmarks = Auth::user()->bookmarkedPosts()->get();
        return view('pages.bookmarked', compact('bookmarks'));
    }
    
}
