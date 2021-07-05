@extends('layout')

@section('title') Users @endsection

@section('main_layout_content')

<div class="row justify-content-md-center">

<div class="col-6">
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        Profile
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <form method='post' action='/user'>
          @method('PUT')
          @csrf
          <label for="name" class="form-label">Name</label>
          <input type='name' name='name' value='{{ $user->name }}' id='name' class='form-control'><br>
          <label for="email" class="form-label">Email</label>
          <input type='email' name='email' value='{{ $user->email }}' id='email' class='form-control'><br>
          <button type='submit' class='btn btn-outline-success'>Save</button>
        </form>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Telegram
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <form method='post' action='/user/telegram'>
          @method('PUT')
          @csrf
          <label for="chat_id" class="form-label">Chat id</label>
          <input type='chat_id' name='chat_id' value='{{ $user->chat_id }}' id='chat_id' class='form-control'><br>
          <button type='submit' class='btn btn-outline-success'>Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

</div>

@endsection