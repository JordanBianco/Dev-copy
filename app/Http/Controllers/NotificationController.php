<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('user.notification.index');
    }

    public function store($id)
    {
        auth()->user()->unreadnotifications->where('id', $id)->markAsRead();

        return back();
    }

    public function readAll()
    {
        auth()->user()->unreadnotifications->markAsRead();

        return back();
    }
}
