<?php

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendMessage(Request $request)
    {
        event(new MessageNotification($request->input('data'), $request->input('ID')));
    }
}
