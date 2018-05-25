<script>
import Pagination from '../PaginationComponent.vue';

new Vue({
    el: '#departmentsCrud',
    created: function() {
        this.spinnerLoading = true;
        this.indexDepartments();
        this.indexUsers();
        this.spinnerLoading = false;
    },
    data: function() {
        return {
            // Spinner.
            //---------------------
            spinnerLoading: false,

            // Departaments.
            //---------------------
            departments: [],
            department: {
                'id': '',
                'name': '',
                'description': '',
            },

            // Relacions.
            //---------------------
            users: [],

            // Paginació.
            //---------------------
            pagination: {
                'current_page': 1
            },

            // Formulari Crear.
            //---------------------
            createName: '',
            createDescription: '',
            createSelectedTeachers: [],
            createDepartmentManager: '',

            // Formulari Editar.
            //---------------------
            editName: '',
            editDescription: '',
            editSelectedTeachers: [],
            editDepartmentManager: '',
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
         * GET => Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController@index
         **********************************************************************/
        indexDepartments: function() {
            var url = '/api/scool/programming/departments?page=' + this.pagination.current_page;
            axios.get(url).then(response => {
                var departments = response.data.apiResponseData.data.data;
                var pagination  = response.data.apiResponseData.pagination;
                
                this.departments = departments;
                this.pagination  = pagination;
            });
        },
        indexUsers: function() {
            var url = '/api/users';
            axios.get(url).then(response => {
                var users  = response.data.apiResponseData.data.data;
                this.users = users;
            });
        },
    //     /**
    //      * DESTROY
    //      * DELETE => Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController@destroy
    //      **********************************************************************/
    //     destroyUser: function(id) {
    //         var url = '/api/scool/programming/departments/' + id;
    //         axios.delete(url).then(response => {
    //             var success = response.data.success;
    //             var message = response.data.message;

    //             if (success == false) {
    //                 toastr.warning(message, 'Warning');    // Notificar Error.
    //             } else {
    //                 this.indexDepartments();                     // Llistar (refrescar).
    //                 $('#modal-delete').modal('hide'); // Tancar modal.
    //                 toastr.success(message, 'Success');    // Notificar OK.
    //             }
    //         });
    //     },
    //     /* Modal
    //     --------------------------------------------------------------------- */
    //     deleteModal: function(user) {
    //         this.user.id    = user.id;
    //         this.user.name  = user.name;
    //         this.user.email = user.email;

    //         $('#modal-delete').modal('show'); // Obrir modal.
    //     },
        /**
         * STORE
         * POST => Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController@store
         **********************************************************************/
        storeDepartment: function() {
            var url = '/api/scool/programming/departments';
            axios.post(url, {
                name: this.createName,
                description: this.createDescription,
                teachers: this.createSelectedTeachers,
                manager: this.createDepartmentManager,
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
                        if (errors.description) {
                            $('textarea[name=description]').addClass('is-invalid');
                            $('#feedCreateEmail').text(errors.description);
                        } else {
                            $('textarea[name=description]')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                    }
                } else {
                    this.indexDepartments();        // Llistar (refrescar).
                    this.createName           = ''; // Reset valor input...
                    this.createDescription    = '';
                    $('input[name=name]').removeClass('is-invalid is-valid'); // Reset errors input...
                    $('textarea[name=description]').removeClass('is-invalid is-valid');
                    $('#modal-create').modal('hide');   // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        createModal: function() {
            $('input[name=name]').removeClass('is-invalid is-valid'); // Reset errors input...
            $('textarea[name=description]').removeClass('is-invalid is-valid');

            $('#modal-create').modal('show'); // Obrir modal.
        },
        /* Reset Create Form
        --------------------------------------------------------------------- */
        resetCreateForm: function() {
            // Feed de validació.
            $('input[name=name]').removeClass('is-invalid is-valid');
            $('textarea[name=description]').removeClass('is-invalid is-valid');

            // Contingut dels camps.
            this.createName             = '';
            this.createDescription      = '';
            this.createSelectedTeachers = [];
            this.createDepartmentManager = '';
        },
        // /**
        //  * UPDATE
        //  * UPDATE => Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController@update
        //  **********************************************************************/
        // updateDepartment: function(id) {
        //     var url = '/api/scool/programming/departments/' + id;
        //     axios.put(url, {
        //         name: this.editName,
        //         description: this.editDescription,
        //     }).then(response => {
        //         var success = response.data.success;
        //         var type    = response.data.type;
        //         var message = response.data.message;
        //         var errors  = response.data.apiResponseData;
                
        //         if (success == false) {
        //             if (type == 'warning') {
        //                 toastr.warning(message, 'Warning'); // Notificar Warning.
        //             } else {
        //                 toastr.error(message, 'Error');     // Notificar Error.

        //                 // Aplicar classes Bootstrap als formularis segons si les
        //                 // dades són vàlides o no. També afegim el missatge de
        //                 // l'error, aquest lligat a cada input pel seu "name".
        //                 if (errors.name) {
        //                     $('input[name=name]').addClass('is-invalid');
        //                     $('#feedEditName').text(errors.name);
        //                 } else {
        //                     $('input[name=name]')
        //                         .removeClass('is-invalid')
        //                         .addClass('is-valid');
        //                 }
        //                 if (errors.email) {
        //                     $('textarea[name=description]').addClass('is-invalid');
        //                     $('#feedEditEmail').text(errors.email);
        //                 } else {
        //                     $('textarea[name=description]')
        //                         .removeClass('is-invalid')
        //                         .addClass('is-valid');
        //                 }
        //                 if (errors.password) {
        //                     $('input[name=password]').addClass('is-invalid');
        //                     $('input[name=password_confirmation]').addClass('is-invalid');
        //                     $('#feedEditPass').text(errors.password);
        //                 } else {
        //                     $('input[name=password]')
        //                         .removeClass('is-invalid')
        //                         .addClass('is-valid');
        //                     $('input[name=password_confirmation]')
        //                         .removeClass('is-invalid')
        //                         .addClass('is-valid');
        //                 }
        //             }
        //         } else {
        //             this.indexDepartments();      // Llistar (refrescar).
        //             this.editName     = ''; // Reset valor input...
        //             this.editEmail    = '';
        //             this.editPassword = '';
        //             this.editPasswordConfirm = '';
        //             $('input[name=name]').removeClass('is-invalid is-valid'); // Reset errors input...
        //             $('textarea[name=description]').removeClass('is-invalid is-valid');
        //             $('input[name=password]').removeClass('is-invalid is-valid');
        //             $('input[name=password_confirmation]').removeClass('is-invalid is-valid');
        //             $('#modal-edit').modal('hide');     // Tancar modal.
        //             toastr.success(message, 'Success'); // Notificar OK.
        //         }
        //     });
        // },
        // /* Modal
        // --------------------------------------------------------------------- */
        // editModal: function(user) {
        //     // data           user             // Emplenar valors input...
        //     this.user.id    = user.id;
        //     this.user.name  = user.name;
        //     this.user.email = user.email;

        //     // data          data
        //     this.editName  = this.user.name;
        //     this.editEmail = this.user.email;
            
        //     this.editPassword        = ''; // Reset valors password inputs...
        //     this.editPasswordConfirm = '';

        //     $('input[name=name]').removeClass('is-invalid is-valid'); // Reset errors input...
        //     $('textarea[name=description]').removeClass('is-invalid is-valid');
        //     $('input[name=password]').removeClass('is-invalid is-valid');
        //     $('input[name=password_confirmation]').removeClass('is-invalid is-valid');

        //     $('#modal-edit').modal('show'); // Obrir modal.
        // },
    }
});
</script>
