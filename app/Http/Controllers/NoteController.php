<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    // Get all notes | method: GET | host:port/note
    public function getAllNotes() {
        $note = new Note();

        return view('notes', ['notes' => $note->where('user_id', Auth::id())->get()]);
    }

    // Add new note | method: POST | host:port/note
    public function addNote(Request $request) {
        $valid = $request->validate([
            'title' => 'required|min:1|max:255',
            'content' => 'required|min:1',
        ]);

        $note = new Note();
        $note->user_id = Auth::id();
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        return redirect()->route('note');
    }

    // Get note | method: GET | host:port/note/{id}
    public function getNote(Request $request) {
        $note = Note::find($request->id);

        if ($note != null && $note->user_id == Auth::id()) {
            return view('note', ['note' => $note]);
        } else {
            abort(404);
        }
    }

    // Update note | method: PUT | host:port/note/{id}
    public function updateNote(Request $request) {
        $note = Note::find($request->id);

        if ($note != null && $note->user_id == Auth::id()) {
            $note->title = $request->input('title');
            $note->content = $request->input('content');
            $note->save();
        }

        return redirect()->route('note');
    }

    // Delete note | method: DELETE | host:port/note/{id}
    public function delNote(Request $request) {
        $note = Note::find($request->id);

        if ($note != null && $note->user_id == Auth::id()) {
            $note->delete();
        }

        return redirect()->route('note');
    }
}
