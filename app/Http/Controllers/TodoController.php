<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todosToDisplay = Todo::orderBy('created_at', 'desc')->get();
        return view('todos', ['todos' => $todosToDisplay]);
    }

    public function create(Request $request)
    {
        //Allowed input
        $allowedTags = '<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
        $allowedTags .= '<li><ol><ul><span><div><br><ins><del>';

        Todo::create([
            'title' => strip_tags(stripslashes($request->title), $allowedTags),
            'body' => strip_tags(stripslashes($request->body), $allowedTags) . "\n",
        ]);

        return redirect('/');
    }
}
