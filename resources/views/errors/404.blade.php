@extends('layouts.errors')

@section('content')
<div class="container-fluid bg-primary h-100">
    <div class="row align-items-center h-100">
        <div class="col">
            <h1 class="text-center text-light display-3">
                Pàgina no trobada...
            </h1>

            <h2 class="text-center mt-5">
                <a href="{{ url('/') }}" class="text-light">
                    <i class="fas fa-undo"></i> Tornar
                </a>
            </h2>
        </div>
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
