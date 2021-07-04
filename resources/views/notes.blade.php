@extends('layout')

@section('title') Notes @endsection

@section('main_layout_content')

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
@foreach($notes as $note)
  <div class="col">
    <div class="card text-dark bg-light">
      <div class="card-header">
        <a class="btn btn-outline-secondary btn-sm" href="/note/{{ $note->id }}" role="button" title="Edit"><i class="bi bi-pencil"></i></a>
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#delNoteModal{{ $note->id }}" title="Delete"><i class="bi bi-trash"></i></button>
        @if($note->notify_at != null)
          <button type="button" class="btn btn-outline-secondary btn-sm" disabled><i class="bi bi-alarm"></i> {{ $note->notify_at }}</button>
        @endif
      </div>
      <div class="card-body">
        <h5 class="card-title">{{ $note->title }}</h5>
        <p class="card-text">{{ $note->content }}</p>
      </div>
      <div class="card-footer"><small class="text-muted"><em>{{ $note->updated_at }}</em></small></div>
    </div>
  </div

  <!-- Modal delete note -->
  <div class="modal fade" id="delNoteModal{{ $note->id }}" tabindex="-1" aria-labelledby="delNoteModal{{ $note->id }}" aria-hidden="true">
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
@endforeach
</div>

@endsection