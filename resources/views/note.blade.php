@extends('layout')

@section('title') Note {{ $note->id }} @endsection

@section('main_layout_content')

<form method='post' action='/note/{{ $note->id }}'>
    @method('PUT')
    @csrf
    <input type='title' name='title' value='{{ $note->title }}' id='title' class='form-control'><br>
    <textarea name='content' id='content' class='form-control'>{{ $note->content }}</textarea><br>
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group me-2" role="group">
            <a class="btn btn-secondary" href="/note" role="button">Cancel</a>
        </div>
        <div class="btn-group me-2" role="group">
            <button type='submit' class='btn btn-success'>Save</button>
        </div>
</form>

        <div class="btn-group" role="group">
            <form method='post' action='/note/{{ $note->id }}'> 
                @csrf
                @method('DELETE')
                <button type='submit' class='btn btn-danger'>Delete</button>
            </form>
        </div>

    </div>
@endsection