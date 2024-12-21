<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ItemList;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Redirect;

class BookmarkController extends Controller
{
    public function save(ItemList $list)
    {
        $bookmark = Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'item_list_id' => $list->id,
        ]);

        return response()->json([
            'success' => true,
            'bookmarked' => true,
            'message' => 'Post Bookmarked!',
        ]);
    }

    public function destroy(ItemList $list)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())->where('item_list_id', $list->id)->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json([
                'success' => true,
                'bookmarked' => false,
                'message' => 'Deleted from Bookmark!',
            ]);
        }

        return response()->json([
            'success' => false,
            'bookmarked' => false,
            'message' => 'Error: Bookmark not found.',
        ]);
    }
 
    public function bookmarked()
    {
        // $bookmarks = Bookmark::where('user_id', '=', Auth::id())->paginate(6);
        // $post_ids = $bookmarks->pluck('post_id');
        // $items = ItemList::whereIn('id', $post_ids)->get();
        // return view('pages.bookmarked', ['bookmarks' => $bookmarks, 'items' => $items]);

        
        $data = [
            'category_name' => 'posts',
            'page_name' => 'bookmarks',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        
        // $posts = ItemList::paginate(6);
        $bookmarks = Auth::user()->bookmarkedPosts()->get();
        return view('posts.bookmarked', compact('bookmarks'))->with($data);
    }
    
}
