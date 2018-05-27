<div class="modal fade" id="modal-show" tabindex="-1" role="dialog"
     aria-labelledby="modalShow" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShow">
                    @{{ show.promodule.name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- COS -->
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Information</h6>
                        <!-- Info -->
                        <dl class="row">
                            <dt class="col-sm-4">Department</dt>
                            <dd class="col-sm-8">@{{ show.promoduleD.name }}</dd>
                            <dt class="col-sm-4">Section 1</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-check-circle text-success"
                                    v-if="show.promodule.section1 != null"></i>
                                <i class="fas fa-times-circle text-danger"
                                    v-else></i>
                            </dd>
                            <dt class="col-sm-4">Section 2</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-check-circle text-success"
                                    v-if="show.promodule.section2 != null"></i>
                                <i class="fas fa-times-circle text-danger"
                                    v-else></i>
                            </dd>
                            <dt class="col-sm-4">Section 3</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-check-circle text-success"
                                    v-if="show.promodule.section3 != null"></i>
                                <i class="fas fa-times-circle text-danger"
                                    v-else></i>
                            </dd>
                            <dt class="col-sm-4">Section 4</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-check-circle text-success"
                                    v-if="show.promodule.section4 != null"></i>
                                <i class="fas fa-times-circle text-danger"
                                    v-else></i>
                            </dd>
                        </dl>
                        <hr>
                        <!-- Unitats Formatives -->
                        <div class="accordion" id="accordionTrainingUnits">
                            <div class="card">
                                <div class="card-header" id="trainingUnitsPromodules">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseTrainingUnitsPromodules"
                                                aria-expanded="true"
                                                aria-controls="collapseOne">
                                            <span class="badge badge-primary">@{{ show.promoduleT.length }}</span> Training Units
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTrainingUnitsPromodules"
                                        class="collapse"
                                        aria-labelledby="trainingUnitsPromodules"
                                        data-parent="#accordionTrainingUnits">
                                    <div class="card-body">
                                        <ul>
                                            <span v-if="show.promoduleT.length == 0"
                                                  class="text-muted">
                                                <small>No data yet.</small>
                                            </span>
                                            <li v-for="trainingUnits in show.promoduleT"
                                                :key="trainingUnits.id">
                                                @{{ trainingUnits.name }}
                                                <hr>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.accordion -->
                    </div>
                </div><!-- /.card -->
            </div>

            <!-- Botons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->