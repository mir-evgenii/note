@extends('layout')

@section('title') Notes @endsection

@section('main_layout_content')

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach($notes as $note)
      <div class="col">
        <div class="card text-dark bg-light">
          <!-- <div class="card-header"></div> -->
          <div class="card-body">
            <h5 class="card-title">{{ $note->title }}</h5>
            <p class="card-text">{{ $note->content }}</p>
          </div>
          <div class="card-footer"><small class="text-muted"><em>{{ $note->updated_at }}</em></small></div>
        </div>
      </div>
    @endforeach
    </div>

@endsection