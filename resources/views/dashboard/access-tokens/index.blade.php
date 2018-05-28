@extends('layouts.app')

@section('content')
<div id="app" class="container">
    <!-- BREADCRUMBS -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ action('Web\DashboardController@index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Access Tokens</li>
        </ol>
    </nav>
    
    <!-- COS -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <passport-clients class="my-4"></passport-clients>
                    <passport-authorized-clients class="my-4"></passport-authorized-clients>
                    <passport-personal-access-tokens class="my-4"></passport-personal-access-tokens>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
