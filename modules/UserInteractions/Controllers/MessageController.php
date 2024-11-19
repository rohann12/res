<?php

namespace Modules\UserInteractions\Controllers;

use App\Http\Controllers\Controller;
use Modules\Visitor\Models\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('status', 'desc')->latest()->simplePaginate(5);
        return view('admin.messages', compact('messages'));
    }

    public function toggleStatus($id)
    {
        $message = Message::findOrFail($id);
        $message->status = ($message->status == Message::STATUS_UNREAD) ? Message::STATUS_READ : Message::STATUS_UNREAD;
        $message->save();

        return redirect()->back()->with('success', 'Message status toggled successfully!');
    }
}
