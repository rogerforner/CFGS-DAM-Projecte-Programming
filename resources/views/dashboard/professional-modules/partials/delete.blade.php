<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog"
     aria-labelledby="modalDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDelete">Delete Professional Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Cos -->
            <div class="modal-body">
                <!-- Info avís -->
                <p><strong>Are you sure to delete the professional module?</strong>,<br>
                This action is irreversible, you will not be able to recover the data.</p>
                <!-- Info dades -->
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Information</h6>
                        <dl class="row">
                            <dt class="col-sm-4">Name</dt>
                            <dd class="col-sm-8">@{{ show.promodule.name }}</dd>
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
                    </div>
                </div>
            </div>
            <!-- Peu -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
                <button type="button" class="btn btn-danger"
                        @click.prevent="destroyProfessionalModule(show.promodule.id)">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->