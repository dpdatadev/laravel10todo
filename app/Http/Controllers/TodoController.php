<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        //Show 10 most recently created TODO's that are not completed
        $todosToDisplay = Todo::where('is_completed', 0)->orderBy('created_at', 'desc')->take(15)->get();
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

        return redirect()->route('todos.index')->withSuccess(__('TODO submitted!'));
    }
}
