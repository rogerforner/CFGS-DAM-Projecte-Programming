@extends('layouts.app')

@section('content')
<div class="container">
    <!-- BREADCRUMBS -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ action('Web\DashboardController@index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Professional Modules</li>
        </ol>
    </nav>
    
    <!-- COS -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
