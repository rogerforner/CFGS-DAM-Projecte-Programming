<template>
    <div class="container-fluid">
        <!-- TÍTOL + AFEGIR -->
        <div class="row">
            <div class="col-md-9">
                <h5 class="card-title">Users</h5>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary btn-block"
                @click.prevent="formNewUserModal()">New User</button>
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
                                <button type="button" class="btn btn-primary" title="See">
                                    <i class="far fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-dark" title="Edit"
                                @click.prevent="formEditUserModal(user)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-danger" title="Delete"
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
                                @click.prevent="destroyUser($event)">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <!-- MODAL: FORM CREAR -->
        <div class="modal fade" id="modal-cform-user" tabindex="-1" role="dialog"
             aria-labelledby="modalFormCreateUser" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormCreateUser">
                            New User
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" v-on:submit.prevent="storeUser">
                        <!-- Camps del formulari -->
                        <div class="modal-body">
                            <!-- Nom -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="cName" name="name" value=""
                                       class="form-control" required
                                       v-model="inputName">
                                <div id="mcfiName" class="invalid-feedback"></div>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input type="email" id="cEmail" name="email" value=""
                                       class="form-control" required
                                       v-model="inputEmail">
                                <div id="mcfiEmail" class="invalid-feedback"></div>
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="cPassword" name="password"
                                       class="form-control" autocomplete="off" required
                                       v-model="inputPassword">
                                <div id="mcfiPass" class="invalid-feedback"></div>
                            </div>
                            <!-- Password Confirm -->
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>
                                <input type="password" id="cPassword-confirm" name="password_confirmation"
                                       class="form-control" autocomplete="off" required
                                       v-model="inputPasswordConfirm">
                                <div id="mcfiPassC" class="invalid-feedback"></div>
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

        <!-- MODAL: FORM EDITAR -->
        <div class="modal fade" id="modal-eform-user" tabindex="-1" role="dialog"
             aria-labelledby="modalFormEditUser" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormEditUser">
                            Edit User
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" v-on:submit.prevent="updateUser">
                        <!-- Camps del formulari -->
                        <div class="modal-body">
                            <!-- User ID (hidden) -->
                            <input type="hidden" id="eUserId" name="userid" value=""
                                   class="form-control" v-model="inputUserId">
                            <!-- Nom -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="eName" name="name" value=""
                                       class="form-control" required
                                       v-model="inputName">
                                <div id="mefiName" class="invalid-feedback"></div>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input type="email" id="eEmail" name="email" value=""
                                       class="form-control" required
                                       v-model="inputEmail">
                                <div id="mefiEmail" class="invalid-feedback"></div>
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="ePassword" name="password"
                                       class="form-control" autocomplete="off"
                                       v-model="inputPassword">
                                <div id="mefiPass" class="invalid-feedback"></div>
                            </div>
                            <!-- Password Confirm -->
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>
                                <input type="password" id="ePassword-confirm" name="password_confirmation"
                                       class="form-control" autocomplete="off"
                                       v-model="inputPasswordConfirm">
                                <div id="mefiPassC" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <!-- Botons -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-dark">
                                Edit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal -->
    </div><!-- /.container-fluid -->
</template>

<script>
export default {
    created: function() {
        this.indexUsers();
    },
    data: function() {
        return {
            // Array d'usuaris.
            users: [],

            // Formulari.
            inputUserId: '',
            inputName: '',
            inputEmail: '',
            inputPassword: '',
            inputPasswordConfirm: '',
        }
    },
    methods: {
        /* Peticions HTTP
        --------------------------------------------------------------------- */
        // GET => API\UserController@index
        indexUsers: function() {
            var url = '/api/users';

            axios.get(url).then(response => {
                var users = response.data.arrData;

                this.users = users;
            });
        },
        // POST => API\UserController@store
        storeUser: function() {
            var url = '/api/users';

            axios.post(url, {
                name: this.inputName,
                email: this.inputEmail,
                password: this.inputPassword,
                password_confirmation: this.inputPasswordConfirm,
            }).then(response => {
                var success = response.data.success;
                var type    = response.data.type;
                var message = response.data.message;
                var errors  = response.data.arrData;
                
                if (success == false) {
                    if (type == 'warning') {
                        toastr.warning(message); // Notificar Warning.
                    } else {
                        toastr.error(message);   // Notificar Error.

                        // Aplicar classes Bootstrap als formularis segons si les
                        // dades són vàlides o no. També afegim el missatge de
                        // l'error, aquest lligat a cada input pel seu "name".
                        if (errors.name) {
                            $('input[name=name]').addClass('is-invalid');
                            $('#mcfiName').text(errors.name);
                        } else {
                            $('input[name=name]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                        if (errors.email) {
                            $('input[name=email]').addClass('is-invalid');
                            $('#mcfiEmail').text(errors.email);
                        } else {
                            $('input[name=email]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                        if (errors.password) {
                            $('input[name=password]').addClass('is-invalid');
                            $('input[name=password_confirmation]').addClass('is-invalid');
                            $('#mcfiPass').text(errors.password);
                        } else {
                            $('input[name=password]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                            $('input[name=password_confirmation]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                    }
                } else {
                    this.indexUsers();        // Llistar (refrescar).
                    this.inputName     = '';  // Reset valor input...
                    this.inputEmail    = '';
                    this.inputPassword = '';
                    this.inputPasswordConfirm = '';
                    $('input[name=name]').removeClass('is-invalid is-valid'); // Reset color input...
                    $('input[name=email]').removeClass('is-invalid is-valid');
                    $('input[name=password]').removeClass('is-invalid is-valid');
                    $('input[name=password_confirmation]').removeClass('is-invalid is-valid');
                    $('#modal-cform-user').modal('hide'); // Tancar modal.
                    toastr.success(message);              // Notificar OK.
                }
            });
        },
        // UPDATE => API\UserController@update
        updateUser: function() {
            var url = '/api/users/' + id;

            axios.post(url, {
                name: this.inputName,
                email: this.inputEmail,
                password: this.inputPassword,
                password_confirmation: this.inputPasswordConfirm,
            }).then(response => {
                var success = response.data.success;
                var type    = response.data.type;
                var message = response.data.message;
                var errors  = response.data.arrData;
                
                if (success == false) {
                    if (type == 'warning') {
                        toastr.warning(message); // Notificar Warning.
                    } else {
                        toastr.error(message);   // Notificar Error.

                        // Aplicar classes Bootstrap als formularis segons si les
                        // dades són vàlides o no. També afegim el missatge de
                        // l'error, aquest lligat a cada input pel seu "name".
                        if (errors.name) {
                            $('input[name=name]').addClass('is-invalid');
                            $('#mcfiName').text(errors.name);
                        } else {
                            $('input[name=name]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                        if (errors.email) {
                            $('input[name=email]').addClass('is-invalid');
                            $('#mcfiEmail').text(errors.email);
                        } else {
                            $('input[name=email]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                        if (errors.password) {
                            $('input[name=password]').addClass('is-invalid');
                            $('input[name=password_confirmation]').addClass('is-invalid');
                            $('#mcfiPass').text(errors.password);
                        } else {
                            $('input[name=password]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                            $('input[name=password_confirmation]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                    }
                } else {
                    this.indexUsers();                     // Llistar (refrescar).
                    this.inputName     = '';             // Reset valor input...
                    this.inputEmail    = '';
                    this.inputPassword = '';
                    this.inputPasswordConfirm = '';
                    $('input[name=name]').removeClass('is-invalid is-valid'); // Reset color input...
                    $('input[name=email]').removeClass('is-invalid is-valid');
                    $('input[name=password]').removeClass('is-invalid is-valid');
                    $('input[name=password_confirmation]').removeClass('is-invalid is-valid');
                    $('#modal-form-user').modal('hide'); // Tancar modal.
                    toastr.success(message);             // Notificar OK.
                }
            });
        },
        // DELETE => API\UserController@destroy
        // Cridat a través del mètode deleteUserModal().
        destroyUser: function(event) {
            var btnDeleteObject = event.target;
            var btnAttrValue    = btnDeleteObject.getAttribute('userid');
            var url             = '/api/users/' + btnAttrValue;

            axios.delete(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    toastr.warning(message); // Notificar Error.
                } else {
                    this.indexUsers();                       // Llistar (refrescar).
                    $('#modal-delete-user').modal('hide'); // Tancar modal.
                    toastr.success(message);               // Notificar OK.
                }
            });
        },
        /* Components
        --------------------------------------------------------------------- */
        deleteUserModal: function(user) {
            $('#modal-delete-user').modal('show'); // Obrir modal.
            $('#mduBtn').attr('userid', user.id);  // Attr userid="n".
            $('#mduName').text(user.name);         // Mostrar el Nom.
            $('#mduEmail').text(user.email);       // Mostrar l'eMail.
        },
        formNewUserModal: function() {
            $('#modal-cform-user').modal('show'); // Obrir modal.
        },
        formEditUserModal: function(user) {
            $('#modal-eform-user').modal('show'); // Obrir modal.
            $('input#eUserId').val(user.id);      // Mostrar l'ID.
            $('input#eName').val(user.name);      // Mostrar el Nom.
            $('input#eEmail').val(user.email);    // Mostrar l'eMail.
        },
    }
}
</script>
