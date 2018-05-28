@extends('layouts.app')

@section('content')
<div class="container">
    <!-- BREADCRUMBS -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ action('Web\DashboardController@index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Temaries</li>
        </ol>
    </nav>
    
    <!-- COS -->
    <div id="temariesCrud" class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">
                            <!-- TÍTOL + AFEGIR -->
                            <div class="row">
                                <div class="col-md-9">
                                    <h5 class="card-title">
                                        Temaries <span class="badge badge-primary" v-cloak>
                                            @{{ pagination.total }}
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary btn-block"
                                            @click.prevent="createModal()"
                                            v-if="index.tunits.length != 0">
                                        <i class="fas fa-plus-circle"></i> New Temary
                                    </button>
                                </div>
                                <div class="alert alert-warning col-md-12 text-center"
                                     role="alert"
                                     v-if="index.tunits.length == 0" v-cloak>
                                    You can not create Temaries without training units.
                                </div>
                            </div><!-- /.row -->
                            <!-- SPINNER -->
                            <div id="spinner" class="row align-items-center my-5"
                                 v-if="spinnerLoading">
                                <div class="col-2 mx-auto">
                                    <i class="fas fa-spinner fa-pulse fa-5x text-primary"></i>
                                </div>
                            </div>
                            <!-- LLISTA DE NUCLIS FORMATIUS -->
                            <div class="row mt-5" v-cloak>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <caption v-if="index.temarieswp.length != 0"><small>List of temaries.</small></caption>
                                        <caption v-else><small>No data yet.</small></caption>
                                        <thead class="bg-primary text-light">
                                            <tr>
                                                <th scope="col">TU</th>
                                                <th scope="col">NF</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Duration</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Created</th>
                                                <th scope="col">Updated</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Creem un filtre:
                                            1. Només l'usuari autor té accés als seus MP.
                                            3. L'Administrador té accés a tots els MP. --}}
                                            <tr v-for="temary in index.temarieswp"
                                                :key="temary.id"
                                                v-if="temary.created_by == index.userAuth.email ||
                                                      index.userAuth.email == 'profea@example.com' ||
                                                      index.userAuth.id == 1">
                                                <th scope="row">@{{ temary.training_unit_id }}</th>
                                                <td>@{{ temary.nf }}</td>
                                                <td>@{{ temary.name }}</td>
                                                <td>@{{ temary.duration }} h</td>
                                                <td>@{{ temary.description }}</td>
                                                <td>
                                                    @{{ since(temary.created_at) }}
                                                    <span class="text-muted d-block"
                                                          v-if="temary.created_by">
                                                        <small>by @{{ temary.created_by }}</small>
                                                    </span>
                                                </td>
                                                <td>
                                                    @{{ since(temary.updated_at) }}
                                                    <span class="text-muted d-block"
                                                          v-if="temary.updated_by">
                                                        <small>by @{{ temary.updated_by }}</small>
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- MOSTRAR -->
                                                    <button type="button" class="btn btn-primary"
                                                        @click.prevent="showModal(temary.id)">
                                                        <i class="fas fa-eye"></i> Show
                                                    </button>
                                                    <!-- EDITAR -->
                                                    <button type="button" class="btn btn-dark"
                                                            @click.prevent="editModal(temary.id)">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </button>
                                                    <!-- ELIMINAR -->
                                                    <button type="button" class="btn btn-danger"
                                                            @click.prevent="deleteModal(temary.id)">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <pagination v-if="pagination.last_page > 1"
                                                :pagination="pagination"
                                                :offset="5" @paginate="indexTemaries()"
                                                v-cloak>
                                    </pagination>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
            <!-- MODALS -->
            @include('dashboard.temaries.partials.create')
            @include('dashboard.temaries.partials.edit')
            @include('dashboard.temaries.partials.delete')
            @include('dashboard.temaries.partials.show')
        </div><!-- /.row -->
    </div><!-- /.container -->
    @endsection
    