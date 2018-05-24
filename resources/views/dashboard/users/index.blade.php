@extends('layouts.app')

@section('content')
<div class="container">
    <!-- BREADCRUMBS -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ action('Web\DashboardController@index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    <!-- COS -->
    <div id="usersCrud" class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <!-- TÍTOL + AFEGIR -->
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title">
                                    Users <span class="badge badge-primary" v-cloak>
                                        @{{ pagination.total }}
                                    </span>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-block"
                                        @click.prevent="createModal()">
                                    <i class="fas fa-plus-circle"></i> New User
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
                        <!-- LLISTA DE USUARIS -->
                        <div class="row mt-5" v-cloak>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <caption><small>User list.</small></caption>
                                    <thead class="bg-primary text-light">
                                        <tr>
                                            <th scope="col">Avatar</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">eMail</th>
                                            <th scope="col">Provider</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Updated</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in users" :key="user.id">
                                            <td>
                                                <img :src="user.avatar"
                                                     class="rounded rounded-circle"
                                                     height="44px" alt="userName"
                                                     v-if="user.avatar">
                                            </td>
                                            <td>@{{ user.name }}</td>
                                            <td>@{{ user.email }}</td>
                                            <td>@{{ user.provider }}</td>
                                            <td>
                                                @{{ since(user.created_at) }}
                                                <span class="text-muted d-block"
                                                      v-if="user.created_by">
                                                    <small>by @{{ user.created_by }}</small>
                                                </span>
                                            </td>
                                            <td>
                                                @{{ since(user.updated_at) }}
                                                <span class="text-muted d-block"
                                                      v-if="user.updated_by">
                                                    <small>by @{{ user.updated_by }}</small>
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-dark"
                                                        @click.prevent="editModal(user)">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                        @click.prevent="deleteModal(user)">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5" @paginate="indexUsers()"
                                            v-cloak>
                                </pagination>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col -->
        <!-- MODALS -->
        @include('dashboard.users.partials.create')
        @include('dashboard.users.partials.edit')
        @include('dashboard.users.partials.delete')
    </div><!-- /.row -->
</div><!-- /.container -->
@endsection
