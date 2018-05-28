@extends('layouts.app')

@section('content')
<div class="container">
    <!-- BREADCRUMBS -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                                    Programming
                                </h5>
                            </div>
                        </div><!-- /.row -->
                        
                        <!-- LLISTA DE MÒDULS PROFESSIONALS APROVATS -->
                        <div class="row mt-5">
                            <div class="table-responsive">
                                
                                <ul class="list-group list-group-flush mb-4">
                                    @forelse ($mpsApproved as $promodule)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <!-- Nom del Departament -->
                                                <div class="col">
                                                    {{ $promodule->department->name }}
                                                </div>
                                                <!-- Informació del mòdul -->
                                                <div class="col">
                                                    <div class="row">
                                                        <dt class="col-sm-3">
                                                            <a href="{{ url('dashboard/print-mp/'.$promodule->id) }}" class="text-danger">
                                                                <i class="far fa-file-pdf"></i>
                                                            </a> 
                                                            MP {{ $promodule->mp }}
                                                        </dt>
                                                        <dd class="col-sm-9">{{ $promodule->name }}</dd>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    @foreach ($promodule->trainingUnits as $tunit)
                                                        @if ($tunit->approved == true)
                                                            <div class="row">
                                                                <dt class="col-sm-3">
                                                                    <a href="{{ url('dashboard/print-uf/'.$tunit->id) }}" class="text-danger">
                                                                        <i class="far fa-file-pdf"></i>
                                                                    </a> 
                                                                    UF {{ $tunit->uf }}
                                                                </dt>
                                                                <dd class="col-sm-9">{{ $tunit->name }}</dd>
                                                                <dt class="col-sm-3">Starts</dt>
                                                                <dd class="col-sm-9">{{ $tunit->date_start }}</dd>
                                                                <dt class="col-sm-3">Ends</dt>
                                                                <dd class="col-sm-9">{{ $tunit->date_end }}</dd><hr>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="list-group-item">No data yet.</li>
                                    @endforelse
                                </ul>

                                <!-- Paginació -->
                                {{ $mpsApproved->links() }}
                                
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
