<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    //
    public function push(Request $request)
    {
        $conversation = new Conversation();

        $conversation->userType = $request->userType;
        $conversation->text = $request->text;
        $conversation->save();

        return [
            "success" => true,
        ];
    }

    public function pull()
    {
        $conversation = Conversation::all();
        return [
            "data" => $conversation
        ];
    }

    public function clear()
    {
        Conversation::truncate();
    }
}
