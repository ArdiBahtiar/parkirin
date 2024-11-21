<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\ItemList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function chatIndex(Conversation $conversation)
    {
        $data = [
            'category_name' => 'apps',
            'page_name' => 'chat',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        if(!in_array(Auth::id(), [$conversation->user_one_id, $conversation->user_two_id]))
        {
            abort(403, 'Lu itu ngga diajak :( ');
        }
        return view('posts.chat', ['conversationId' => $conversation->id])->with($data);
    }

    public function store(Request $request)
    {
        $data = [
            'category_name' => 'apps',
            'page_name' => 'chat',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $message = new Message();
        $message->user_id = Auth::id();
        $message->message = $request->message;
        $message->save();

        return response()->json($message, 201)->with($data);
    }

    public function initiate($id)
    {
        $data = [
            'category_name' => 'apps',
            'page_name' => 'chat',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        $list = ItemList::find($id);
        $authId = Auth::id();
        $listUserId = $list->id_owner;
        $conversation = Conversation::where(function ($query) use ($authId, $listUserId) {
            $query->where('user_one_id', $authId)
                  ->where('user_two_id', $listUserId);
        })->orWhere(function ($query) use ($authId, $listUserId) {
            $query->where('user_one_id', $listUserId)
                  ->where('user_two_id', $authId);
        })->first();
    
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $authId,
                'user_two_id' => $listUserId,
            ]);
        }
        return redirect()->route('chat.show', ['conversation' => $conversation->id])->with($data);
    }
}
