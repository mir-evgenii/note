@extends('layout')

@section('title') Note {{ $note->id }} @endsection

@section('main_layout_content')

<form method='post' action='/note/{{ $note->id }}'>
    @method('PUT')
    @csrf
    <input type='title' name='title' value='{{ $note->title }}' id='title' class='form-control'><br>
    <textarea name='content' id='content' class='form-control'>{{ $note->content }}</textarea><br>
    <div class="btn-group" role="group">
        <a class="btn btn-outline-secondary" href="/note" role="button">Cancel</a>
        <button type='submit' class='btn btn-outline-success'>Save</button>
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delNoteModal">Delete</button>
    </div>
</form>

<!-- Modal delete note -->
<div class="modal fade" id="delNoteModal" tabindex="-1" aria-labelledby="delNoteModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>Do you really want to delete note: "{{ $note->title }}"?</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form method='post' action='/note/{{ $note->id }}'> 
            @csrf
            @method('DELETE')
            <button type='submit' class='btn btn-danger'>Delete</button>
          </form>
        </div>
      </div>
    </div>
</div>

@endsection