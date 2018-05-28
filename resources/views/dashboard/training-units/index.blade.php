@extends('layouts.app')

@section('content')
<div class="container">
    <!-- BREADCRUMBS -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ action('Web\DashboardController@index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Training Units</li>
        </ol>
    </nav>
    
    <!-- COS -->
    <div id="tunitsCrud" class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <!-- TÍTOL + AFEGIR -->
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title">
                                    Training Units <span class="badge badge-primary" v-cloak>
                                        @{{ pagination.total }}
                                    </span>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-block"
                                        @click.prevent="createModal()"
                                        v-if="index.promodules.length != 0">
                                    <i class="fas fa-plus-circle"></i> New Training Unit
                                </button>
                            </div>
                            <div class="alert alert-warning col-md-12 text-center"
                                 role="alert"
                                 v-if="index.promodules.length == 0" v-cloak>
                                You can not create Training Units without professional modules.
                            </div>
                        </div><!-- /.row -->
                        <!-- SPINNER -->
                        <div id="spinner" class="row align-items-center my-5"
                             v-if="spinnerLoading">
                            <div class="col-2 mx-auto">
                                <i class="fas fa-spinner fa-pulse fa-5x text-primary"></i>
                            </div>
                        </div>
                        <!-- LLISTA DE UNITATS FORMATIVES -->
                        <div class="row mt-5" v-cloak>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <caption v-if="index.tunitswp.length != 0"><small>List of training units.</small></caption>
                                    <caption v-else><small>No data yet.</small></caption>
                                    <thead class="bg-primary text-light">
                                        <tr>
                                            <th scope="col">UF</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Dates</th>
                                            <th scope="col">S1</th>
                                            <th scope="col">S2</th>
                                            <th scope="col">S3</th>
                                            <th scope="col">S4</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Updated</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Creem un filtre:
                                        1. Només l'usuari autor té accés als seus MP.
                                        3. L'Administrador té accés a tots els MP. --}}
                                        <tr v-for="trainingUnit in index.tunitswp"
                                            :key="trainingUnit.id"
                                            v-if="trainingUnit.created_by == index.userAuth.email ||
                                                  index.userAuth.email == 'profea@example.com' ||
                                                  index.userAuth.id == 1">
                                            <td>@{{ trainingUnit.uf }}</td>
                                            <td>@{{ trainingUnit.name }}</td>
                                            <td>
                                                @{{ since(trainingUnit.date_start) }}<br>
                                                @{{ since(trainingUnit.date_end) }}
                                            </td>
                                            <td>
                                                <i class="fas fa-check-circle text-success"
                                                   v-if="trainingUnit.section1 != null"></i>
                                                <i class="fas fa-times-circle text-danger"
                                                   v-else></i>
                                            </td>
                                            <td>
                                                <i class="fas fa-check-circle text-success"
                                                   v-if="trainingUnit.section2 != null"></i>
                                                <i class="fas fa-times-circle text-danger"
                                                   v-else></i>
                                            </td>
                                            <td>
                                                <i class="fas fa-check-circle text-success"
                                                   v-if="trainingUnit.section3 != null"></i>
                                                <i class="fas fa-times-circle text-danger"
                                                   v-else></i>
                                            </td>
                                            <td>
                                                <i class="fas fa-check-circle text-success"
                                                   v-if="trainingUnit.section4 != null"></i>
                                                <i class="fas fa-times-circle text-danger"
                                                   v-else></i>
                                            </td>
                                            <td>
                                                @{{ since(trainingUnit.created_at) }}
                                                <span class="text-muted d-block"
                                                      v-if="trainingUnit.created_by">
                                                    <small>by @{{ trainingUnit.created_by }}</small>
                                                </span>
                                            </td>
                                            <td>
                                                @{{ since(trainingUnit.updated_at) }}
                                                <span class="text-muted d-block"
                                                      v-if="trainingUnit.updated_by">
                                                    <small>by @{{ trainingUnit.updated_by }}</small>
                                                </span>
                                            </td>
                                            <td>
                                                {{-- Creem un filtre:
                                                1. El Cap de departament té accés a tots els MP.
                                                2. L'Administrador té accés a tots els MP. --}}
                                                <div class="d-inline"
                                                     v-if="index.userAuth.email == 'profea@example.com' ||
                                                           index.userAuth.id == 1">
                                                    <!-- APROVAR -->
                                                    <button type="button" class="btn btn-success"
                                                            :disabled="trainingUnit.section1 == null ||
                                                                       trainingUnit.section2 == null ||
                                                                       trainingUnit.section3 == null ||
                                                                       trainingUnit.section4 == null"
                                                            v-if="trainingUnit.approved == false"
                                                            @click.prevent="approveModal(trainingUnit.id)">
                                                       <i class="fas fa-thumbs-up"></i> Approve
                                                   </button>
                                                   <!-- DESAPROVAR -->
                                                   <button type="button" class="btn btn-warning"
                                                           :disabled="trainingUnit.approve"
                                                           v-if="trainingUnit.approved == true"
                                                           @click.prevent="approveTrainingUnit(trainingUnit.id, false)">
                                                       <i class="fas fa-thumbs-down"></i> Disapprove
                                                   </button>
                                                </div>
                                                <!-- MOSTRAR -->
                                                <button type="button" class="btn btn-primary"
                                                    @click.prevent="showModal(trainingUnit.id)">
                                                    <i class="fas fa-eye"></i> Show
                                                </button>
                                                <!-- EDITAR -->
                                                <button type="button" class="btn btn-dark"
                                                        @click.prevent="editModal(trainingUnit.id)"
                                                        :disabled="trainingUnit.approved != false">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </button>
                                                <!-- ELIMINAR -->
                                                <button type="button" class="btn btn-danger"
                                                        @click.prevent="deleteModal(trainingUnit.id)"
                                                        :disabled="trainingUnit.approved != false">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5" @paginate="indexTrainingUnits()"
                                            v-cloak>
                                </pagination>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col -->
        <!-- MODALS -->
        @include('dashboard.training-units.partials.create')
        @include('dashboard.training-units.partials.edit')
        @include('dashboard.training-units.partials.delete')
        @include('dashboard.training-units.partials.show')
        @include('dashboard.training-units.partials.approve')
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
