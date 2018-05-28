<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog"
     aria-labelledby="modalDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDelete">Delete Temary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Cos -->
            <div class="modal-body">
                <!-- Info avís -->
                <p><strong>Are you sure to delete the temary?</strong>,<br>
                This action is irreversible, you will not be able to recover the data.</p>
                <!-- Info dades -->
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Information</h6>
                        <dl class="row">
                            <dt class="col-sm-4">T. Unit</dt>
                            <dd class="col-sm-8">[@{{ show.temaryT.uf }}] @{{ show.temaryT.name }}</dd>
                            <dt class="col-sm-4">Name</dt>
                            <dd class="col-sm-8">[@{{ show.temary.nf }}] @{{ show.temary.name }}</dd>
                            <dt class="col-sm-4">Duration</dt>
                            <dd class="col-sm-8">@{{ show.temary.duration }} h</dd>
                            <dt class="col-sm-4">Description</dt>
                            <dd class="col-sm-8">@{{ show.temary.description }}</dd>
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
                        @click.prevent="destroyTemary(show.temary.id)">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->