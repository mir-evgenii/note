@extends('layout')

@section('title') Notes @endsection

@section('main_layout_content')

<form method='put' action='/note/{{ $note->id }}'>
    @csrf
    <input type='title' name='title' value='{{ $note->title }}' id='title' placeholder='Title' class='form-control'><br>
    <textarea name='content' value='{{ $note->content }}' id='content' placeholder='Content' class='form-control'></textarea><br>
    <button type='submit' class='btn btn-success'>Save</button>
</form>

@endsection