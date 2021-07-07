<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\NoteNotifications;
use DateTime;

class NoteController extends Controller
{
    // Get all notes | method: GET | host:port/note
    public function getAllNotes() {
        $notes = Note::where('user_id', Auth::id())
            ->select('notes.id', 'title', 'content', 'notes.updated_at', 'note_notifications.notify_at', 'note_notifications.send')
            ->leftJoin('note_notifications', 'notes.id', '=', 'note_notifications.note_id')
            ->get();

        return view('notes', ['notes' => $notes]);
    }

    // Add new note | method: POST | host:port/note
    public function addNote(Request $request) {
        $valid = $request->validate([
            'title' => 'required|min:1|max:255',
            'content' => 'required|min:1',
            'notify_at' => 'nullable|date|after:now',
        ]);

        $note = new Note();
        $note->user_id = Auth::id();
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        if ($request->input('notify_at') != null) {
            $notify = new NoteNotifications();
            $notify->note_id = $note->id;
            $notify->notify_at = $request->input('notify_at');
            $notify->save();
        }

        return redirect()->route('note');
    }

    // Get note | method: GET | host:port/note/{id}
    public function getNote(Request $request) {
        $note = Note::where('notes.id', $request->id)
            ->where('user_id', Auth::id())
            ->select('notes.id', 'title', 'content', 'notes.updated_at', 'note_notifications.notify_at', 'note_notifications.send')
            ->leftJoin('note_notifications', 'notes.id', '=', 'note_notifications.note_id')
            ->first();

        if ($note != null) {
            return view('note', ['note' => $note]);
        } else {
            abort(404);
        }
    }

    // Update note | method: PUT | host:port/note/{id}
    public function updateNote(Request $request) {
        $valid = $request->validate([
            'title' => 'required|min:1|max:255',
            'content' => 'required|min:1',
            'notify_at' => 'nullable|date|after:now',
        ]);

        $note = Note::where('id', $request->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($note != null) {
            $note->title = $request->input('title');
            $note->content = $request->input('content');
            $note->save();

            if ($request->input('notify_at') != null) {
                $notify = NoteNotifications::where('note_id', $note->id)->first();
                if ($notify == null) {
                    $notify = new NoteNotifications();
                    $notify->note_id = $note->id;
                }
                $notify->notify_at = $request->input('notify_at');
                $notify->send = false;
                $notify->save();
            }
        }

        return redirect()->route('note');
    }

    // Delete note | method: DELETE | host:port/note/{id}
    public function delNote(Request $request) {
        $note = Note::where('id', $request->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($note != null) {
            $notify = NoteNotifications::where('note_id', $note->id)->first();
            if ($notify != null) {
                $notify->delete();
            }
            $note->delete();
        }

        return redirect()->route('note');
    }
}
