<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    // Get all notes | method: GET | host:port/note
    public function getAllNotes() {
        $note = new Note();

        return view('notes', ['notes' => $note->all()]);
    }

    // Add new note | method: POST | host:port/note
    public function addNote(Request $request) {
        $valid = $request->validate([
            'title' => 'required|min:1|max:255',
            'content' => 'required|min:1',
        ]);

        $note = new Note();
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        return redirect()->route('note');
    }

    // Get note | method: GET | host:port/note/{id}
    public function getNote(Request $request) {
        $note = Note::find($request->id);

        return view('note', ['note' => $note]);
    }

    // Update note | method: PUT | host:port/note/{id}
    public function updateNote(Request $request) {
        $note = Note::find($request->id);
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        return redirect()->route('note');
    }

    // Delete note | method: DELETE | host:port/note/{id}
    public function delNote(Request $request) {
        Note::find($request->id)->delete();

        return redirect()->route('note');
    }
}
