<?php

use Illuminate\Support\Facades\Route;
use App\Events\MessageSent;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-message', function () {
    // Envia uma mensagem de teste via websocket
    broadcast(new MessageSent('Olá, websocket!'));

    return view('websocket');
});

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/chat/send', function (\Illuminate\Http\Request $request) {
    broadcast(new MessageSent($request->input('message')));
    return response()->json(['status' => 'Mensagem enviada!']);
});
