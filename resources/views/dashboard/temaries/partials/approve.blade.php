<div class="modal fade" id="modal-approve" tabindex="-1" role="dialog"
     aria-labelledby="modalApprove" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalApprove">
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
                            <dt class="col-sm-4">Date Start</dt>
                            <dd class="col-sm-8">@{{ show.tunit.date_start }}</dd>
                            <dt class="col-sm-4">Date End</dt>
                            <dd class="col-sm-8">@{{ show.tunit.date_end }}</dd>
                            <dt class="col-sm-4">4 Sections</dt>
                            <dd class="col-sm-8">
                                <i class="fas fa-check-circle text-success"></i>
                            </dd>
                        </dl>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <span class="badge badge-primary">@{{ show.tunitT.length }}</span> Temaries
                        </h6>
                        <div class="alert alert-warning" role="alert"
                             v-if="show.tunitT.length == 0">
                             If you approve the Training Unit, the Temaries section will not appear.
                        </div>
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
                </div><!-- /.card -->
            </div>

            <!-- Botons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
                <button type="button" class="btn btn-success"
                        @click.prevent="approveTrainingUnit(show.tunit.id, true)"
                        v-if="index.promodules.length != 0">
                    Approve
                </button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->