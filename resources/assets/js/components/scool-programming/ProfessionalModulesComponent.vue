<script>
import Pagination from '../PaginationComponent.vue';

new Vue({
    el: '#promodulesCrud',
    created: function() {
        this.spinnerLoading = true;
        this.indexProfessionalModules();
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
                promoduleswp: [], // With pagination.
                promodules: [],
                departments: [],
                userAuth: '',
            },
            show: {
                promodule: '',
                promoduleD: '',
                promoduleT: [],
            },
            form: {
                createMp: '',
                createName: '',
                createSection1: '',
                createSection2: '',
                createSection3: '',
                createSection4: '',
                createDepartment: '',
                editMp: '',
                editName: '',
                editSection1: '',
                editSection2: '',
                editSection3: '',
                editSection4: '',
                editDepartment: '',
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
            this.show.promodule  = '';
            this.show.promoduleD = '';
            this.show.promoduleT = [];

            this.form.createMp         = '';
            this.form.createName       = '';
            this.form.createSection1   = '';
            this.form.createSection2   = '';
            this.form.createSection3   = '';
            this.form.createSection4   = '';
            this.form.createDepartment = '';

            this.form.editMp         = '';
            this.form.editName       = '';
            this.form.editSection1   = '';
            this.form.editSection2   = '';
            this.form.editSection3   = '';
            this.form.editSection4   = '';
            this.form.editDepartment = '';
        },

        /**
         * INDEX Departaments
         * GET => Rogerforner\ScoolProgramming\Http\Controllers\API\ProfessionalModuleController@index
         **********************************************************************/
        indexProfessionalModules: function() {
            var url = '/api/scool/programming/professional-modules?promodules=' + this.pagination.current_page;
            axios.get(url).then(response => {
                this.index.promoduleswp = response.data.apiResponseData.promoduleswp.data;
                this.index.promodules   = response.data.apiResponseData.promodules;
                this.index.departments  = response.data.apiResponseData.departments;
                this.index.userAuth     = response.data.apiResponseData.userAuth;

                this.pagination = response.data.apiResponseData.pagination;
            });
        },

        /**
         * SHOW
         * GET => Rogerforner\ScoolProgramming\Http\Controllers\API\ProfessionalModuleController@show
         **********************************************************************/
        showProfessionalModule: function(id) {
            var url = '/api/scool/programming/professional-modules/' + id;
            axios.get(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    console.log('Woops! ' + message);
                } else {
                    console.log('OK ' + message);
                }

                this.show.promodule  = response.data.apiResponseData.promodule;
                this.show.promoduleD = response.data.apiResponseData.promoduleD;
                this.show.promoduleT = response.data.apiResponseData.promoduleT;
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        showModal: function(id) {
            this.showProfessionalModule(id);
            $('#modal-show').modal('show'); // Obrir modal.
        },

        /**
         * DESTROY
         * DELETE => Rogerforner\ScoolProgramming\Http\Controllers\API\ProfessionalModuleController@destroy
         **********************************************************************/
        destroyProfessionalModule: function(id) {
            var url = '/api/scool/programming/professional-modules/' + id;
            axios.delete(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    toastr.warning(message, 'Warning'); // Notificar Error.
                } else {
                    this.indexProfessionalModules();    // Llistar (refrescar).
                    this.resetData();                   // Buidar camps.
                    $('#modal-delete').modal('hide');   // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        deleteModal: function(id) {
            this.showProfessionalModule(id);
            $('#modal-delete').modal('show'); // Obrir modal.
        },

        /**
         * STORE
         * POST => Rogerforner\ScoolProgramming\Http\Controllers\API\ProfessionalModuleController@store
         **********************************************************************/
        storeProfessionalModule: function() {
            var url = '/api/scool/programming/professional-modules';
            axios.post(url, {
                mp:            this.form.createMp,
                name:          this.form.createName,
                section1:      this.form.createSection1,
                section2:      this.form.createSection2,
                section3:      this.form.createSection3,
                section4:      this.form.createSection4,
                department_id: this.form.createDepartment,
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
                    this.indexProfessionalModules();    // Llistar (refrescar).
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
            this.form.createMp         = '';
            this.form.createName       = '';
            this.form.createSection1  = '';
            this.form.createSection2  = '';
            this.form.createSection3  = '';
            this.form.createSection4  = '';
            this.form.createDepartment = '';
        },
        /**
         * UPDATE
         * UPDATE => Rogerforner\ScoolProgramming\Http\Controllers\API\ProfessionalModuleController@update
         **********************************************************************/
        updateProfessionalModule: function(id) {
            var url = '/api/scool/programming/professional-modules/' + id;
            axios.put(url, {
                mp:            this.form.editMp,
                name:          this.form.editName,
                section1:      this.form.editSection1,
                section2:      this.form.editSection2,
                section3:      this.form.editSection3,
                section4:      this.form.editSection4,
                department_id: this.form.editDepartment,
                approved:      false,
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
                    this.indexProfessionalModules();    // Llistar (refrescar).
                    this.resetData();                   // Buidar camps.
                    $('#modal-edit').modal('hide');     // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        editModal: function(id) {
            this.showProfessionalModule(id);

            this.form.editMp       = this.show.promodule.mp;
            this.form.editName     = this.show.promodule.name;
            this.form.editSection1 = this.show.promodule.section1;
            this.form.editSection2 = this.show.promodule.section2;
            this.form.editSection3 = this.show.promodule.section3;
            this.form.editSection4 = this.show.promodule.section4;
            this.form.editDepartment = this.show.promodule.department_id;

            $('#modal-edit').modal('show'); // Obrir modal.
        },
        /**
         * APPROVE & DISAPPROVE
         * UPDATE => Rogerforner\ScoolProgramming\Http\Controllers\API\ProfessionalModuleController@update
         **********************************************************************/
        approveProfessionalModule: function(id, isApproved) {
            var url = '/api/scool/programming/professional-modules/' + id;
            axios.put(url, {
                approved: isApproved,
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
                    this.indexProfessionalModules();    // Llistar (refrescar).
                    $('#modal-approve').modal('hide');  // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        approveModal: function(id) {
            this.showProfessionalModule(id);
            $('#modal-approve').modal('show'); // Obrir modal.
        },
    }
});
</script>
