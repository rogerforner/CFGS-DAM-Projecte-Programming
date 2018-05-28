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
    <div id="departmentsCrud" class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <!-- TÍTOL + AFEGIR -->
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title">
                                    Departments <span class="badge badge-primary" v-cloak>
                                        @{{ pagination.total }}
                                    </span>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-block"
                                        @click.prevent="createModal()">
                                    <i class="fas fa-plus-circle"></i> New Department
                                </button>
                            </div>
                        </div><!-- /.row -->
                        <!-- SPINNER -->
                        <div id="spinner" class="row align-items-center my-5"
                             v-if="spinnerLoading">
                            <div class="col-2 mx-auto">
                                <i class="fas fa-spinner fa-pulse fa-5x text-primary"></i>
                            </div>
                        </div>
                        <!-- LLISTA DE DEPARTAMENTS -->
                        <div class="row mt-5" v-cloak>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <caption v-if="index.departmentswp.length != 0"><small>List of departments.</small></caption>
                                    <caption v-else><small>No data yet.</small></caption>
                                    <thead class="bg-primary text-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Updated</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="department in index.departmentswp" :key="department.id">
                                            <td>@{{ department.name }}</td>
                                            <td>@{{ department.description }}</td>
                                            <td>
                                                @{{ since(department.created_at) }}
                                                <span class="text-muted d-block"
                                                      v-if="department.created_by">
                                                    <small>by @{{ department.created_by }}</small>
                                                </span>
                                            </td>
                                            <td>
                                                @{{ since(department.updated_at) }}
                                                <span class="text-muted d-block"
                                                      v-if="department.updated_by">
                                                    <small>by @{{ department.updated_by }}</small>
                                                </span>
                                            </td>
                                            <td>
                                                <!-- MOSTRAR -->
                                                <button type="button" class="btn btn-primary"
                                                    @click.prevent="showModal(department.id)">
                                                    <i class="fas fa-eye"></i> Show
                                                </button>
                                                <!-- EDITAR -->
                                                <button type="button" class="btn btn-dark"
                                                        @click.prevent="editModal(department.id)">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </button>
                                                <!-- ELIMINAR -->
                                                <button type="button" class="btn btn-danger"
                                                        @click.prevent="deleteModal(department.id)">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5" @paginate="indexDepartments()"
                                            v-cloak>
                                </pagination>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col -->
        <!-- MODALS -->
        @include('dashboard.departments.partials.create')
        @include('dashboard.departments.partials.edit')
        @include('dashboard.departments.partials.delete')
        @include('dashboard.departments.partials.show')
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
