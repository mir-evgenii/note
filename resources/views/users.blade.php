@extends('layout')

@section('title') Users @endsection

@section('main_layout_content')

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col"></th>
    </tr>
  </thead>
@foreach($users as $user)
  <tr>
      <th scope="row">{{ $user->id }}</th>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      @if ($user->id != App\Http\Controllers\UserController::ADMIN_ID)
      <td class="text-end"><button type="button" class="btn btn-outline-secondary btn-sm py-0" data-bs-toggle="modal" data-bs-target="#delUserModal{{ $user->id }}" title="Delete">Delete</button></td>
      @else
      <td class="text-end text-muted">Not deleted</td>
      @endif
  </tr>

  <!-- Modal delete note -->
  <div class="modal fade" id="delUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="delUserModal{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>Do you really want to delete user: "{{ $user->name }}"?</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <form method='post' action='/user/{{ $user->id }}'> 
            @csrf
            @method('DELETE')
            <button type='submit' class='btn btn-outline-danger'>Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endforeach
</table>

@endsection