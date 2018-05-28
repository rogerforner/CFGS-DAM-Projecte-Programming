<div class="modal fade" id="modal-show" tabindex="-1" role="dialog"
     aria-labelledby="modalShow" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShow">
                    @{{ show.temary.name }}
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
                            <dt class="col-sm-4">T. Unit</dt>
                            <dd class="col-sm-8">[@{{ show.temaryT.uf }}] @{{ show.temaryT.name }}</dd>
                            <dt class="col-sm-4">Duration</dt>
                            <dd class="col-sm-8">@{{ show.temary.duration }} h</dd>
                            <dt class="col-sm-4">Description</dt>
                            <dd class="col-sm-8">@{{ show.temary.description }}</dd>
                        </dl>
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