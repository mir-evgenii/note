<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Get bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <!-- Get bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>@yield('title')</title>
</head>
<body>

    <!-- Header -->
    <div class="navbar fixed-top navbar-light bg-light border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <p class="m-3 mb-0 mt-0 lead"><i class="bi bi-file-earmark-text"></i> Note</p>
      </a>

      <nav class="m-3 mb-0 mt-0 d-inline-flex ms-md-auto">
        @if (Illuminate\Support\Facades\Auth::check())
          <a class="py-2 text-dark text-decoration-none" href="/note" title="All notes"><i class="bi bi-grid-3x3-gap"></i></a>
          <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#newNoteModal" title="New note"><i class="bi bi-plus-lg"></i></button>
          <a class="me-3 py-2 text-dark text-decoration-none" href="/dashboard" title="Dashboard"><i class="bi bi-person"></i></a>
          @if (App\Http\Controllers\UserController::isAdmin())
          <a class="me-3 py-2 text-dark text-decoration-none" href="/user" title="All users"><i class="bi bi-people"></i></a>
          @endif
          <a class="me-3 py-2 text-dark text-decoration-none" href="/logout" title="Logout"><i class="bi bi-box-arrow-right"></i></a>
        @else
          <a class="me-3 py-2 text-dark text-decoration-none" href="/register" title="Register"><i class="bi bi-person-plus"></i></a>
          <a class="me-3 py-2 text-dark text-decoration-none" href="/login" title="Login"><i class="bi bi-box-arrow-in-right"></i></a>
        @endif
      </nav>
    </div>

    <!-- New note modal form -->
    <div id="newNoteModal" class="modal fade" aria-labelledby="exampleModalLabel" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method='post' action='/note'>
          <div class="modal-body">
            @csrf
            <input type='now' name='now' id='now' value="{{ date('Y-m-d H:i:s') }}" class='visually-hidden'>
            <input type='notify_at' name='notify_at' id='notify_at' placeholder='yyyy-mm-dd hh:mm:ss' class='form-control'><br>
            <input type='title' name='title' id='title' placeholder='Title' class='form-control'><br>
            <textarea name='content' id='content' placeholder='Content' class='form-control'></textarea><br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type='submit' class='btn btn-outline-success'>Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="mb-5 mt-5 pt-4 container">
    @yield('main_layout_content')
    </div>

    <!-- Footer -->
    <footer class="footer fixed-bottom navbar-light bg-light border-top">
        <small class="d-block text-center text-muted">Evgenii Mironov "Note" 2021</small>
    </footer>

</body>
</html>