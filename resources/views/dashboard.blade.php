@extends('layout')

@section('title') Users @endsection

@section('main_layout_content')

<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="{{ $user->name }}" aria-label="{{ $user->name }}" aria-describedby="button-addon2">
  <input type="text" class="form-control" placeholder="{{ $user->email }}" aria-label="{{ $user->email }}" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
</div>

<div class="text-center">
<a href="/note" class="btn btn-outline-primary">My notes</a>
<a href="/note" class="btn btn-outline-success">Save</a>
<a href="/logout" class="btn btn-outline-danger">Logout</a>
<div>

@endsection