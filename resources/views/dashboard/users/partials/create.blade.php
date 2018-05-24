<div class="modal fade" id="modal-create" tabindex="-1" role="dialog"
     aria-labelledby="modalCreate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreate">
                    New User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FORMULARI -->
            <form method="post" v-on:submit.prevent="storeUser">
                <!-- Camps del formulari -->
                <div class="modal-body">
                    <!-- Nom -->
                    <div class="form-group">
                        <label for="createName">Name</label>
                        <input type="text" id="createName"
                               name="name"
                               class="form-control" required
                               v-model="createName">
                        <div id="feedCreateName" class="invalid-feedback"></div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="createEmail">E-Mail Address</label>
                        <input type="email" id="createEmail"
                               name="email"
                               class="form-control" required
                               v-model="createEmail">
                        <div id="feedCreateEmail" class="invalid-feedback"></div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="feedCreatePass">Password</label>
                        <input type="password" id="feedCreatePass"
                               name="password"
                               class="form-control" autocomplete="off" required
                               v-model="createPassword">
                        <div id="feedCreatePass" class="invalid-feedback"></div>
                    </div>

                    <!-- Password Confirm -->
                    <div class="form-group">
                        <label for="createPassConfirm">Confirm Password</label>
                        <input type="password" id="createPassConfirm"
                               name="password_confirmation"
                               class="form-control" autocomplete="off" required
                               v-model="createPasswordConfirm">
                        <div id="feedCreatePassConfirm" class="invalid-feedback"></div>
                    </div>
                </div>

                <!-- Botons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->