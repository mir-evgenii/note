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
    <div class="d-flex flex-column flex-md-row align-items-center mb-3 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <h1 class="display-6" class="fs-4"><i class="bi bi-file-earmark-text"></i> Note</h1>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="/note">Notes</a>
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#newNoteModal"><i class="bi bi-plus-lg"></i></button>
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
          <form method='post' action='/note/add'>
          <div class="modal-body">
            @csrf
            <input type='title' name='title' id='title' placeholder='Title' class='form-control'><br>
            <textarea name='content' id='content' placeholder='Content' class='form-control'></textarea><br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type='submit' class='btn btn-success'>Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container">
    @yield('main_layout_content')
    </div>

    <!-- Footer -->
    <footer class="pt-2 my-md-3 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <small class="d-block text-center mb-3 text-muted">Evgenii Mironov "Note" 2021</small>
      </div>
    </div>
  </footer>

</body>
</html>