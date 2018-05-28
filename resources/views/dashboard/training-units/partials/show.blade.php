<div class="modal fade" id="modal-show" tabindex="-1" role="dialog"
     aria-labelledby="modalShow" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShow">
                    @{{ show.tunit.name }}
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
                            <dt class="col-sm-4">Pro. Module</dt>
                            <dd class="col-sm-8">@{{ show.tunitP.name }}</dd>
                            <dt class="col-sm-4">Name</dt>
                            <dd class="col-sm-8">@{{ show.tunit.name }}</dd>
                            <dt class="col-sm-4">Date Start</dt>
                            <dd class="col-sm-8">@{{ show.tunit.date_start }}</dd>
                            <dt class="col-sm-4">Date End</dt>
                            <dd class="col-sm-8">@{{ show.tunit.date_end }}</dd>
                            <dt class="col-sm-4">Section 1</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-check-circle text-success"
                                    v-if="show.tunit.section1 != null"></i>
                                <i class="fas fa-times-circle text-danger"
                                    v-else></i>
                            </dd>
                            <dt class="col-sm-4">Section 2</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-check-circle text-success"
                                    v-if="show.tunit.section2 != null"></i>
                                <i class="fas fa-times-circle text-danger"
                                    v-else></i>
                            </dd>
                            <dt class="col-sm-4">Section 3</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-check-circle text-success"
                                    v-if="show.tunit.section3 != null"></i>
                                <i class="fas fa-times-circle text-danger"
                                    v-else></i>
                            </dd>
                            <dt class="col-sm-4">Section 4</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-check-circle text-success"
                                    v-if="show.tunit.section4 != null"></i>
                                <i class="fas fa-times-circle text-danger"
                                    v-else></i>
                            </dd>
                        </dl>
                        <hr>
                        <!-- Nuclfis Formatius -->
                        <div class="accordion" id="accordionTemaries">
                            <div class="card">
                                <div class="card-header" id="trainingUnitsTemaries">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseTrainingUnitsTemaries"
                                                aria-expanded="true"
                                                aria-controls="collapseOne">
                                            <span class="badge badge-primary">@{{ show.tunitT.length }}</span> Temaries
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTrainingUnitsTemaries"
                                        class="collapse"
                                        aria-labelledby="trainingUnitsTemaries"
                                        data-parent="#accordionTemaries">
                                    <div class="card-body">
                                        <ul>
                                            <span v-if="show.tunitT.length == 0"
                                                  class="text-muted">
                                                <small>No data yet.</small>
                                            </span>
                                            <li v-for="temary in show.tunitT"
                                                :key="temary.id">
                                                @{{ temary.name }}
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