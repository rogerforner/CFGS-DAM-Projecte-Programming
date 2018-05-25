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
            // Complements.
            //---------------------
            spinnerLoading: false,
            pagination: {
                'current_page': 1
            },

            // Dades.
            //---------------------
            index: {
                departments: [],
                users: [],
            },
            show: {
                department: '',
                departmentM: '',
                departmentUs: [],
                departmentMP: [],
            },
            form: {
                createName: '',
                createDescription: '',
                createSelectedTeachers: [],
                createDepartmentManager: '',
                editName: '',
                editDescription: '',
                editSelectedTeachers: [],
                editDepartmentManager: '',
            },
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
         * RESET
         * Buidar variables.
         **********************************************************************/
        resetData: function() {
            this.show.department   = '';
            this.show.departmentM  = '';
            this.show.departmentUs = [];
            this.show.departmentMP = [];

            this.createName              = '';
            this.createDescription       = '';
            this.createSelectedTeachers  = [];
            this.createDepartmentManager = '';
            this.editName                = '';
            this.editDescription         = '';
            this.editSelectedTeachers    = [];
            this.editDepartmentManager   = '';
        },

        /**
         * INDEX Departaments
         * GET => Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController@index
         **********************************************************************/
        indexDepartments: function() {
            var url = '/api/scool/programming/departments?departments=' + this.index.current_page;
            axios.get(url).then(response => {
                this.index.departments = response.data.apiResponseData.data.data;
                this.pagination  = response.data.apiResponseData.pagination;
            });
        },
        /**
         * INDEX Usuaris
         * GET => API\UserController@index
         **********************************************************************/
        indexUsers: function() {
            var url = '/api/users?page=' + this.pagination.current_page;
            axios.get(url).then(response => {
                this.index.users = response.data.apiResponseData.data.data;
            });
        },

        /**
         * SHOW
         * GET => Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController@show
         **********************************************************************/
        showDepartment: function(id) {
            var url = '/api/scool/programming/departments/' + id;
            axios.get(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    console.log('Woops! ' + message);
                } else {
                    console.log('OK ' + message);
                }

                this.show.department   = response.data.apiResponseData.department;
                this.show.departmentM  = response.data.apiResponseData.departmentM;
                this.show.departmentUs = response.data.apiResponseData.departmentUs;
                this.show.departmentMP = response.data.apiResponseData.departmentMP;
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        showModal: function(id) {
            this.showDepartment(id);
            $('#modal-show').modal('show'); // Obrir modal.
        },

        /**
         * DESTROY
         * DELETE => Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController@destroy
         **********************************************************************/
        destroyDepartment: function(id) {
            var url = '/api/scool/programming/departments/' + id;
            axios.delete(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    toastr.warning(message, 'Warning'); // Notificar Error.
                } else {
                    this.indexDepartments();            // Llistar (refrescar).
                    this.resetData();                   // Buidar camps.
                    $('#modal-delete').modal('hide');   // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        deleteModal: function(id) {
            this.showDepartment(id);
            $('#modal-delete').modal('show'); // Obrir modal.
        },

        /**
         * STORE
         * POST => Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController@store
         **********************************************************************/
        storeDepartment: function() {
            var url = '/api/scool/programming/departments';
            axios.post(url, {
                name:        this.form.createName,
                description: this.form.createDescription,
                teachers:    this.form.createSelectedTeachers,
                manager:     this.form.createDepartmentManager,
            }).then(response => {
                var success = response.data.success;
                var type    = response.data.type;
                var message = response.data.message;
                var errors  = response.data.apiResponseData;

                if (success == false) {
                    if (type == 'warning') {
                        toastr.warning(message, 'Warning');   // Notificar Warning.
                    } else {
                        toastr.error(message, 'Error');       // Notificar Error.
                        $.each(errors, function(key, value) { // Info error.
                            toastr.warning(
                                '<em>' + value + '</em>',
                                'Information', {
                                    timeOut: 10000
                                }
                            );
                        });
                    }
                } else {
                    this.indexDepartments();            // Llistar (refrescar).
                    this.resetData();                   // Buidar camps.
                    $('#modal-create').modal('hide');   // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        createModal: function() {
            $('#modal-create').modal('show'); // Obrir modal.
        },
        /* Botó Reset
        --------------------------------------------------------------------- */
        resetCreateForm: function() {
            this.form.createName              = '';
            this.form.createDescription       = '';
            this.form.createSelectedTeachers  = [];
            this.form.createDepartmentManager = '';
        },
        /**
         * UPDATE
         * UPDATE => Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController@update
         **********************************************************************/
        updateDepartment: function(id) {
            var url = '/api/scool/programming/departments/' + id;
            axios.put(url, {
                name:        this.form.editName,
                description: this.form.editDescription,
                teachers:    this.form.editSelectedTeachers,
                manager:     this.form.editDepartmentManager,
            }).then(response => {
                var success = response.data.success;
                var type    = response.data.type;
                var message = response.data.message;
                var errors  = response.data.apiResponseData;

                if (success == false) {
                    if (type == 'warning') {
                        toastr.warning(message, 'Warning');   // Notificar Warning.
                    } else {
                        toastr.error(message, 'Error');       // Notificar Error.
                        $.each(errors, function(key, value) { // Info error.
                            toastr.warning(
                                '<em>' + value + '</em>',
                                'Information', {
                                    timeOut: 10000
                                }
                            );
                        });
                    }
                } else {
                    this.indexDepartments();            // Llistar (refrescar).
                    this.resetData();                   // Buidar camps.
                    $('#modal-edit').modal('hide');     // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        editModal: function(id) {
            this.showDepartment(id);

            this.form.editName              = this.show.department.name;
            this.form.editDescription       = this.show.department.description;
            this.form.editSelectedTeachers  = this.show.departmentUs;
            this.form.editDepartmentManager = this.show.departmentM;

            $('#modal-edit').modal('show'); // Obrir modal.
        },
    }
});
</script>
