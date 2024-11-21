<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index()
    {
        $authId = Auth::id();

        // Fetch users who have chatted with the authenticated user
        $users = DB::select("
            SELECT 
                users.id, 
                users.name, 
                users.email, 
                COUNT(CASE WHEN chats.is_read = 0 AND chats.to = ? THEN 1 END) AS unread
            FROM users
            INNER JOIN chats 
                ON (users.id = chats.from AND chats.to = ?) 
                OR (users.id = chats.to AND chats.from = ?)
            WHERE users.id != ?
            GROUP BY users.id, users.name, users.email
        ", [$authId, $authId, $authId, $authId]);

        $data = [
            'category_name' => 'app',
            'page_name' => 'chat',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];

        return view('posts.chats.index', ['users' => $users])->with($data);
    }

    public function messages($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Chat::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Chat::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('posts.chats.messages', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Chat();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    public function initiate(Request $request)
    {
        $validated = $request->validate([
            'to' => 'required|exists:users,id', // Ensure the recipient exists
            'message' => 'required|string|max:500', // Validate the message
        ]);

        // Save the message in the database
        Chat::create([
            'from' => auth()->id(),
            'to' => $validated['to'],
            'message' => $validated['message'],
            'is_read' => 0, // Mark as unread
        ]);

        return response()->json(['success' => true, 'message' => 'Message sent successfully']);
    }
}
