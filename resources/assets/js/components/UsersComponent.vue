<template>
    <div class="container-fluid">
        <!-- TÍTOL + AFEGIR -->
        <div class="row">
            <div class="col-md-9">
                <h5 class="card-title">Users</h5>
            </div>
            <div class="col-md-3">
                <a class="btn btn-primary btn-block" href="#" role="button">New User</a>
            </div>
        </div><!-- /.row -->
        <!-- LLISTA DE DEPARTAMENTS -->
        <div class="row mt-5">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Name</th>
                            <th scope="col">eMail</th>
                            <th scope="col">Provider</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" :key="user.id">
                            <th scope="row">{{ ++index }}</th>
                            <td>
                                <img :src="user.avatar"
                                        class="rounded rounded-circle"
                                        height="44px" alt="userName"
                                        v-if="user.avatar">
                            </td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.provider }}</td>
                            <td>
                                <button type="button" class="btn btn-primary"
                                tooltip="tooltip" data-placement="top" title="See">
                                    <i class="far fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-dark"
                                tooltip="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-danger"
                                tooltip="tooltip" data-placement="top" title="Delete"
                                @click.prevent="deleteUserModal(user)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.row -->

        <!-- MODAL: DELETE -->
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
                                    <dd id="mduName" class="col-sm-9"></dd>
                                    <dt class="col-sm-3">eMail</dt>
                                    <dd id="mduEmail" class="col-sm-9"></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close
                        </button>
                        <button id="mduBtn" type="button" class="btn btn-danger"
                                @click.prevent="deleteUser($event)">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <!-- MODAL: FORM -->
        <div class="modal fade" id="modal-form-user" tabindex="-1" role="dialog"
             aria-labelledby="modalFormUser" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormUser">XXXXX</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulari -->
                        <div class="card">
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close
                        </button>
                        <button id="mfuBtn" type="button" class="btn btn-danger"
                                @click.prevent="storeUser($event)">
                            XXXXX
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->
    </div><!-- /.container-fluid -->
</template>

<script>
export default {
    created: function() {
        this.getUsers();
    },
    data: function() {
        return {
            users: []
        }
    },
    methods: {
        /* Peticions HTTP
        --------------------------------------------------------------------- */
        // GET => API\UserController@index
        getUsers: function() {
            var url = '/api/users';

            axios.get(url).then(response => {
                this.users = response.data;
            });
        },
        // DELETE => API\UserController@destroy
        // Cridat a través del mètode deleteUserModal().
        deleteUser: function(event) {
            $('#modal-delete-user').modal('hide'); // Tancar modal.

            var btnDeleteObject = event.target;
            var btnAttrValue    = btnDeleteObject.getAttribute('userid');
            var url             = '/api/users/' + btnAttrValue;

            axios.delete(url).then(response => {
                this.getUsers();                      // Llistar (refrescar).
                toastr.success('Removed correctly.'); // Notificar.
            });
        },
        /* Components
        --------------------------------------------------------------------- */
        deleteUserModal: function(user) {
            $('#modal-delete-user').modal('show');   // Obrir modal.
            $('#mduName').text(user.name);           // Mostrar el Nom.
            $('#mduEmail').text(user.email);         // Mostrar l'eMail.
            $('#mduBtn').attr('userid', user.id); // Afegir attr "userid" amb valor id de l'usuari.
        },
    }
}
</script>
