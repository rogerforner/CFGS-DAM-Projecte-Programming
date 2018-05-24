<div class="modal fade" id="modal-delete-user" tabindex="-1" role="dialog"
     aria-labelledby="modalDeleteUser" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteUser">Delete user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Cos -->
            <div class="modal-body">
                <!-- Info avís -->
                <p><strong>Are you sure to delete the user?</strong>,<br>
                This action is irreversible, you will not be able to recover the data.</p>
                <!-- Info del material -->
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Information</h6>
                        <dl class="row">
                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-9">@{{ user.name }}</dd>
                            <dt class="col-sm-3">eMail</dt>
                            <dd class="col-sm-9">@{{ user.email }}</dd>
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
                        @click.prevent="destroyUser(user.id)">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->