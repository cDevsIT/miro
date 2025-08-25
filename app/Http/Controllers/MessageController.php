<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $message = Message::create([
            'customer_id' => Auth::guard('customer')->id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'read_status' => false
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully'
        ]);
    }
} 