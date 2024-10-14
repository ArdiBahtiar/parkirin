<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;

class Chat extends Component
{
    public $messages = [];
    public $newMessage;
    public $user;
    public $conversationId;

    public function mount($conversationId)
    {
        // dd($this->messages);
        
        $this->user = Auth::user();
        $this->conversationId = $conversationId;
        
        $conversation = Conversation::findOrFail($conversationId);
        if(!in_array($this->user->id, [$conversation->user_one_id, $conversation->user_two_id]))
        {
            abort(403, 'Lu itu ngga diajak :( ');
        }
        
        $this->messages = Message::where('conversation_id', $conversationId)->with('user')->get();
    }

    public function sendMessage()
    {
        $conversation = Conversation::findOrFail($this->conversationId);
        if(!in_array($this->user->id, [$conversation->user_one_id, $conversation->user_two_id]))
        {
            abort(403, 'Lu itu ngga diajak :( ');
        }

        Message::create([
            'user_id' => $this->user->id,
            'conversation_id' => $this->conversationId,
            'message' => $this->newMessage,
        ]);

        $this->newMessage = '';
        $this->messages = Message::where('conversation_id', $this->conversationId)->with('user')->get();
    }

    public function render()
    {
        // $this->messages = Message::all();                    lazy loading
        // $this->messages = Message::with('user')->get();      eager loading
        $this->messages = Message::with('user')->whereHas('conversation', function($query) {
            $query->where('id', $this->conversationId);
        })->get();
        
        return view('livewire.chat');
    }
}