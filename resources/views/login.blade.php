<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Informació del lloc web -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Login page">
    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid h-100">
      <div class="row align-items-center justify-content-center h-100">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Login</h5>
              <a class="btn btn-primary btn-lg btn-block" href="/login/facebook" role="button">
                Facebook <i class="fab fa-facebook"></i>
              </a>
              <a class="btn btn-dark btn-lg btn-block" href="/login/github" role="button">
                GitHub <i class="fab fa-github"></i>
              </a>
              <a class="btn btn-danger btn-lg btn-block" href="/login/google" role="button">
                Google <i class="fab fa-google-plus"></i>
              </a>
              <a class="btn btn-info btn-lg btn-block" href="/login/twitter" role="button">
                Twitter <i class="fab fa-twitter"></i>
              </a>
            </div>
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    
    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
  </body>
</html>