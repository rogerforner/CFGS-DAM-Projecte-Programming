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
    <div id="promodulesCrud" class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <!-- TÍTOL + AFEGIR -->
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title">
                                    Professional Modules <span class="badge badge-primary" v-cloak>
                                        @{{ pagination.total }}
                                    </span>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-block"
                                        @click.prevent="createModal()"
                                        v-if="index.departments.length != 0">
                                    <i class="fas fa-plus-circle"></i> New Professional Module
                                </button>
                            </div>
                            <div class="alert alert-warning col-md-12 text-center"
                                 role="alert"
                                 v-if="index.departments.length == 0" v-cloak>
                                You can not create Professional Modules without departments.
                            </div>
                        </div><!-- /.row -->
                        <!-- SPINNER -->
                        <div id="spinner" class="row align-items-center my-5"
                             v-if="spinnerLoading">
                            <div class="col-2 mx-auto">
                                <i class="fas fa-spinner fa-pulse fa-5x text-primary"></i>
                            </div>
                        </div>
                        <!-- LLISTA DE USUARIS -->
                        <div class="row mt-5" v-cloak>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <caption v-if="index.promoduleswp.length != 0"><small>List of professional modules.</small></caption>
                                    <caption v-else><small>No data yet.</small></caption>
                                    <thead class="bg-primary text-light">
                                        <tr>
                                            <th scope="col">Dpt.</th>
                                            <th scope="col">MP</th>
                                            <th scope="col">Name</th>
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
                                        2. El Cap de departament té accés a tots els MP.
                                        3. L'Administrador té accés a tots els MP. --}}
                                        <tr v-for="promodule in index.promoduleswp"
                                            :key="promodule.id"
                                            v-if="promodule.created_by == index.userAuth.email ||
                                                  index.userAuth.department_id == promodule.department_id ||
                                                  index.userAuth.id == 1">
                                            <th scope="row">@{{ promodule.department_id }}</th>
                                            <td>@{{ promodule.mp }}</td>
                                            <td>@{{ promodule.name }}</td>
                                            <td>
                                                <i class="fas fa-check-circle text-success"
                                                   v-if="promodule.section1 != null"></i>
                                                <i class="fas fa-times-circle text-danger"
                                                   v-else></i>
                                            </td>
                                            <td>
                                                <i class="fas fa-check-circle text-success"
                                                   v-if="promodule.section2 != null"></i>
                                                <i class="fas fa-times-circle text-danger"
                                                   v-else></i>
                                            </td>
                                            <td>
                                                <i class="fas fa-check-circle text-success"
                                                   v-if="promodule.section3 != null"></i>
                                                <i class="fas fa-times-circle text-danger"
                                                   v-else></i>
                                            </td>
                                            <td>
                                                <i class="fas fa-check-circle text-success"
                                                   v-if="promodule.section4 != null"></i>
                                                <i class="fas fa-times-circle text-danger"
                                                   v-else></i>
                                            </td>
                                            <td>
                                                @{{ since(promodule.created_at) }}
                                                <span class="text-muted d-block"
                                                      v-if="promodule.created_by">
                                                    <small>by @{{ promodule.created_by }}</small>
                                                </span>
                                            </td>
                                            <td>
                                                @{{ since(promodule.updated_at) }}
                                                <span class="text-muted d-block"
                                                      v-if="promodule.updated_by">
                                                    <small>by @{{ promodule.updated_by }}</small>
                                                </span>
                                            </td>
                                            <td>
                                                {{-- Creem un filtre:
                                                1. El Cap de departament té accés a tots els MP.
                                                2. L'Administrador té accés a tots els MP. --}}
                                                <div class="d-inline"
                                                     v-if="index.userAuth.department_id == promodule.department_id ||
                                                           index.userAuth.id == 1">
                                                    <!-- APROVAR -->
                                                    <button type="button" class="btn btn-success"
                                                            :disabled="promodule.section1 == null ||
                                                                       promodule.section2 == null ||
                                                                       promodule.section3 == null ||
                                                                       promodule.section4 == null"
                                                            v-if="promodule.approved == false"
                                                            @click.prevent="approveModal(promodule.id)">
                                                       <i class="fas fa-thumbs-up"></i> Approve
                                                   </button>
                                                   <!-- DESAPROVAR -->
                                                   <button type="button" class="btn btn-warning"
                                                           :disabled="promodule.approve"
                                                           v-if="promodule.approved == true"
                                                           @click.prevent="approveProfessionalModule(promodule.id, false)">
                                                       <i class="fas fa-thumbs-down"></i> Disapprove
                                                   </button>
                                                </div>
                                                <!-- MOSTRAR -->
                                                <button type="button" class="btn btn-primary"
                                                    @click.prevent="showModal(promodule.id)">
                                                    <i class="fas fa-eye"></i> Show
                                                </button>
                                                <!-- EDITAR -->
                                                <button type="button" class="btn btn-dark"
                                                        @click.prevent="editModal(promodule.id)"
                                                        :disabled="promodule.approved != false">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </button>
                                                <!-- ELIMINAR -->
                                                <button type="button" class="btn btn-danger"
                                                        @click.prevent="deleteModal(promodule.id)"
                                                        :disabled="promodule.approved != false">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5" @paginate="indexProfessionalModules()"
                                            v-cloak>
                                </pagination>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col -->
        <!-- MODALS -->
        @include('dashboard.professional-modules.partials.create')
        @include('dashboard.professional-modules.partials.edit')
        @include('dashboard.professional-modules.partials.delete')
        @include('dashboard.professional-modules.partials.show')
        @include('dashboard.professional-modules.partials.approve')
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
