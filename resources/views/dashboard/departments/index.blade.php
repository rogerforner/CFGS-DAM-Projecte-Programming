@extends('layouts.app')

@section('content')
<div class="container">
    <!-- BREADCRUMBS -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ action('Web\DashboardController@index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Departments</li>
        </ol>
    </nav>
    
    <!-- COS -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <!-- TÍTOL + AFEGIR -->
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="card-title">Departments</h5>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-primary btn-block" href="#" role="button">New Department</a>
                        </div>
                    </div><!-- /.row -->
                    <!-- LLISTA DE DEPARTAMENTS -->
                    <div class="row mt-5">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-primary text-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">In charge</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1000</th>
                                        <td>Elena Nito del Bosque</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. In, alias!</td>
                                        <td>Inco Foragr</td>
                                        <td>
                                            <button type="button" class="btn btn-primary"
                                            tooltip="tooltip" data-placement="top"title="See">
                                                <i class="far fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-dark"
                                            tooltip="tooltip" data-placement="top"title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                            tooltip="tooltip" data-placement="top"title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div><!-- /.row -->
                </div>
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- PROVISIONAL -->
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @{{ $data}}
                </div>
            </div><!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
