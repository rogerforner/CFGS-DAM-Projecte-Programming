<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog"
     aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">
                    Edit User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FORMULARI -->
            <form method="post" v-on:submit.prevent="updateUser(user.id)">
                <!-- Camps del formulari -->
                <div class="modal-body">
                    <!-- Nom -->
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" id="editName"
                               name="name"
                               class="form-control" required
                               v-model="editName">
                        <div id="feedEditName" class="invalid-feedback"></div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="editEmail">E-Mail Address</label>
                        <input type="email" id="editEmail"
                               name="email"
                               class="form-control" required
                               v-model="editEmail">
                        <div id="feedEditEmail" class="invalid-feedback"></div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input type="password" id="editPassword"
                               name="password"
                               class="form-control" autocomplete="off"
                               v-model="editPassword">
                        <div id="feedEditPass" class="invalid-feedback"></div>
                    </div>

                    <!-- Password Confirm -->
                    <div class="form-group">
                        <label for="editPasswordConfirm">Confirm Password</label>
                        <input type="password" id="editPasswordConfirm"
                               name="password_confirmation"
                               class="form-control" autocomplete="off"
                               v-model="editPasswordConfirm">
                        <div id="feedEditPassConfirm" class="invalid-feedback"></div>
                    </div>
                </div>

                <!-- Botons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->