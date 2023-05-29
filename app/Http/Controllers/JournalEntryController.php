<?php

namespace App\Http\Controllers;

use App\Models\Entry;

class JournalEntryController extends Controller
{
    public function index()
    {
        //Show 10 most recently created Journal Entries
        $entriesToDisplay = Entry::orderBy('created_at', 'desc')->take(5)->get();
        return view('entries', ['entries' => $entriesToDisplay]);
    }

    public function show(int $id)
    {

        $specificJournalEntry = Entry::find($id);
        return view('entry', ['entry' => $specificJournalEntry]);
    }

}

