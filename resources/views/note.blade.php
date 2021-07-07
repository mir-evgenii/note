@extends('layout')

@section('title') Note {{ $note->id }} @endsection

@section('main_layout_content')

<div class="row justify-content-md-center">
<div class="col-6">

<div class="mb-3">
  <p class="text-muted">Last update {{ $note->updated_at }}</p>
</div>

<form method='post' action='/note/{{ $note->id }}'>
    @method('PUT')
    @csrf
    <label for="notify_at" class="form-label">
    Notify
    @if ($note->send)
      (send)
    @endif
    </label>
    <input type='now' name='now' id='now' value="{{ date('Y-m-d H:i:s') }}" class='visually-hidden'>
    <input type='notify_at' name='notify_at' id='notify_at' value='{{ $note->notify_at }}' class='form-control @error("notify_at") is-invalid @enderror'><br>
    <label for="title" class="form-label">Title</label>
    <input type='title' name='title' value='{{ $note->title }}' id='title' class='form-control @error("title") is-invalid @enderror'><br>
    <label for="content" class="form-label">Content</label>
    <textarea name='content' id='content' class='form-control  @error("content") is-invalid @enderror'>{{ $note->content }}</textarea><br>
    <a class="btn btn-outline-secondary" href="/note" role="button">Cancel</a>
    <button type='submit' class='btn btn-outline-success'>Save</button>
    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delNoteModal">Delete</button>
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
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <form method='post' action='/note/{{ $note->id }}'> 
            @csrf
            @method('DELETE')
            <button type='submit' class='btn btn-outline-danger'>Delete</button>
          </form>
        </div>
      </div>
    </div>
</div>

</div>
</div>

@endsection