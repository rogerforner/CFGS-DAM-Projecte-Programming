<script>
import Pagination from './PaginationComponent.vue';

new Vue({
    el: '#usersCrud',
    created: function() {
        this.spinnerLoading = true;
        this.indexUsers();
        this.spinnerLoading = false;
    },
    data: function() {
        return {
            // Spinner.
            //---------------------
            spinnerLoading: false,

            // Usuaris.
            //---------------------
            users: [],
            user: {
                'id': '',
                'name': '',
                'email': '',
                'password': '',
                'password_confirm': '',
            },

            // Paginació.
            //---------------------
            pagination: {
                'current_page': 1
            },

            // Formulari Crear.
            //---------------------
            createName: '',
            createEmail: '',
            createPassword: '',
            createPasswordConfirm: '',

            // Formulari Editar.
            //---------------------
            editName: '',
            editEmail: '',
            editPassword: '',
            editPasswordConfirm: '',
        }
    },
    methods: {
        /**
         * SINCE
         * Formatar les dates.
         **********************************************************************/
        since: function(date) {
            return moment(date).format('ll');
        },
        /**
         * INDEX
         * GET => API\UserController@index
         **********************************************************************/
        indexUsers: function() {
            var url = '/api/users?page=' + this.pagination.current_page;
            axios.get(url).then(response => {
                var users      = response.data.apiResponseData.data.data;
                var pagination = response.data.apiResponseData.pagination;
                
                this.users      = users;
                this.pagination = pagination;
            });
        },
        /**
         * DESTROY
         * DELETE => API\UserController@destroy
         **********************************************************************/
        destroyUser: function(id) {
            var url = '/api/users/' + id;
            axios.delete(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    toastr.warning(message, 'Warning');    // Notificar Error.
                } else {
                    this.indexUsers();                     // Llistar (refrescar).
                    $('#modal-delete').modal('hide'); // Tancar modal.
                    toastr.success(message, 'Success');    // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        deleteModal: function(user) {
            this.user.id    = user.id;
            this.user.name  = user.name;
            this.user.email = user.email;

            $('#modal-delete').modal('show'); // Obrir modal.
        },
        /**
         * STORE
         * POST => API\UserController@store
         **********************************************************************/
        storeUser: function() {
            var url = '/api/users';
            axios.post(url, {
                name: this.createName,
                email: this.createEmail,
                password: this.createPassword,
                password_confirmation: this.createPasswordConfirm,
            }).then(response => {
                var success = response.data.success;
                var type    = response.data.type;
                var message = response.data.message;
                var errors  = response.data.apiResponseData;
                
                if (success == false) {
                    if (type == 'warning') {
                        toastr.warning(message, 'Warning'); // Notificar Warning.
                    } else {
                        toastr.error(message, 'Error');     // Notificar Error.

                        // Aplicar classes Bootstrap als formularis segons si les
                        // dades són vàlides o no. També afegim el missatge de
                        // l'error, aquest lligat a cada input pel seu "name".
                        if (errors.name) {
                            $('input[name=name]').addClass('is-invalid');
                            $('#feedCreateName').text(errors.name);
                        } else {
                            $('input[name=name]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                        if (errors.email) {
                            $('input[name=email]').addClass('is-invalid');
                            $('#feedCreateEmail').text(errors.email);
                        } else {
                            $('input[name=email]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                        if (errors.password) {
                            $('input[name=password]').addClass('is-invalid');
                            $('input[name=password_confirmation]').addClass('is-invalid');
                            $('#feedCreatePass').text(errors.password);
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
                    this.createName     = ''; // Reset valor input...
                    this.createEmail    = '';
                    this.createPassword = '';
                    this.createPasswordConfirm = '';
                    $('input[name=name]').removeClass('is-invalid is-valid'); // Reset errors input...
                    $('input[name=email]').removeClass('is-invalid is-valid');
                    $('input[name=password]').removeClass('is-invalid is-valid');
                    $('input[name=password_confirmation]').removeClass('is-invalid is-valid');
                    $('#modal-create').modal('hide');   // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        createModal: function() {
            $('input[name=name]').removeClass('is-invalid is-valid'); // Reset errors input...
            $('input[name=email]').removeClass('is-invalid is-valid');
            $('input[name=password]').removeClass('is-invalid is-valid');
            $('input[name=password_confirmation]').removeClass('is-invalid is-valid');

            $('#modal-create').modal('show'); // Obrir modal.
        },
        /**
         * UPDATE
         * UPDATE => API\UserController@update
         **********************************************************************/
        updateUser: function(id) {
            var url = '/api/users/' + id;
            axios.put(url, {
                name: this.editName,
                email: this.editEmail,
                password: this.editPassword,
                password_confirmation: this.editPasswordConfirm,
            }).then(response => {
                var success = response.data.success;
                var type    = response.data.type;
                var message = response.data.message;
                var errors  = response.data.apiResponseData;
                
                if (success == false) {
                    if (type == 'warning') {
                        toastr.warning(message, 'Warning'); // Notificar Warning.
                    } else {
                        toastr.error(message, 'Error');     // Notificar Error.

                        // Aplicar classes Bootstrap als formularis segons si les
                        // dades són vàlides o no. També afegim el missatge de
                        // l'error, aquest lligat a cada input pel seu "name".
                        if (errors.name) {
                            $('input[name=name]').addClass('is-invalid');
                            $('#feedEditName').text(errors.name);
                        } else {
                            $('input[name=name]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                        if (errors.email) {
                            $('input[name=email]').addClass('is-invalid');
                            $('#feedEditEmail').text(errors.email);
                        } else {
                            $('input[name=email]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                        if (errors.password) {
                            $('input[name=password]').addClass('is-invalid');
                            $('input[name=password_confirmation]').addClass('is-invalid');
                            $('#feedEditPass').text(errors.password);
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
                    this.indexUsers();      // Llistar (refrescar).
                    this.editName     = ''; // Reset valor input...
                    this.editEmail    = '';
                    this.editPassword = '';
                    this.editPasswordConfirm = '';
                    $('input[name=name]').removeClass('is-invalid is-valid'); // Reset errors input...
                    $('input[name=email]').removeClass('is-invalid is-valid');
                    $('input[name=password]').removeClass('is-invalid is-valid');
                    $('input[name=password_confirmation]').removeClass('is-invalid is-valid');
                    $('#modal-edit').modal('hide');     // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        editModal: function(user) {
            // data           user             // Emplenar valors input...
            this.user.id    = user.id;
            this.user.name  = user.name;
            this.user.email = user.email;

            // data          data
            this.editName  = this.user.name;
            this.editEmail = this.user.email;
            
            this.editPassword        = ''; // Reset valors password inputs...
            this.editPasswordConfirm = '';

            $('input[name=name]').removeClass('is-invalid is-valid'); // Reset errors input...
            $('input[name=email]').removeClass('is-invalid is-valid');
            $('input[name=password]').removeClass('is-invalid is-valid');
            $('input[name=password_confirmation]').removeClass('is-invalid is-valid');

            $('#modal-edit').modal('show'); // Obrir modal.
        },
    }
});
</script>
