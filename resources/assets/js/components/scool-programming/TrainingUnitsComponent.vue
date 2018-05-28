<script>
import Pagination from '../PaginationComponent.vue';

new Vue({
    el: '#tunitsCrud',
    created: function() {
        this.spinnerLoading = true;
        this.indexTrainingUnits();
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
                tunitswp: [], // With pagination.
                tunits: [],
                promodules: [],
                userAuth: '',
            },
            show: {
                tunit: '',
                tunitP: '',
                tunitT: [],
            },
            form: {
                createUf: '',
                createName: '',
                createDateStart: '',
                createDateEnd: '',
                createSection1: '',
                createSection2: '',
                createSection3: '',
                createSection4: '',
                createPromodule: '',
                editUf: '',
                editName: '',
                editDateStart: '',
                editDateEnd: '',
                editSection1: '',
                editSection2: '',
                editSection3: '',
                editSection4: '',
                editPromodule: '',
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
            this.show.tunit  = '';
            this.show.tunitP = '';
            this.show.tunitT = [];

            this.form.createUf        = '';
            this.form.createName      = '';
            this.form.createDateStart = '';
            this.form.createDateEnd   = '';
            this.form.createSection1  = '';
            this.form.createSection2  = '';
            this.form.createSection3  = '';
            this.form.createSection4  = '';
            this.form.createPromodule = '';

            this.form.editUf        = '';
            this.form.editName      = '';
            this.form.editDateStart = '';
            this.form.editDateEnd   = '';
            this.form.editSection1  = '';
            this.form.editSection2  = '';
            this.form.editSection3  = '';
            this.form.editSection4  = '';
            this.form.editPromodule = '';
        },

        /**
         * INDEX Departaments
         * GET => Rogerforner\ScoolProgramming\Http\Controllers\API\TrainingUnitController@index
         **********************************************************************/
        indexTrainingUnits: function() {
            var url = '/api/scool/programming/training-units?tunits=' + this.pagination.current_page;
            axios.get(url).then(response => {
                this.index.tunitswp   = response.data.apiResponseData.tunitswp.data;
                this.index.tunits     = response.data.apiResponseData.tunits;
                this.index.promodules = response.data.apiResponseData.promodules;
                this.index.userAuth   = response.data.apiResponseData.userAuth;

                this.pagination = response.data.apiResponseData.pagination;
            });
        },

        /**
         * SHOW
         * GET => Rogerforner\ScoolProgramming\Http\Controllers\API\TrainingUnitController@show
         **********************************************************************/
        showTrainingUnit: function(id) {
            var url = '/api/scool/programming/training-units/' + id;
            axios.get(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    console.log('Woops! ' + message);
                } else {
                    console.log('OK ' + message);
                }

                this.show.tunit  = response.data.apiResponseData.tunit;
                this.show.tunitP = response.data.apiResponseData.tunitP;
                this.show.tunitT = response.data.apiResponseData.tunitT;
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        showModal: function(id) {
            this.showTrainingUnit(id);
            $('#modal-show').modal('show'); // Obrir modal.
        },

        /**
         * DESTROY
         * DELETE => Rogerforner\ScoolProgramming\Http\Controllers\API\TrainingUnitController@destroy
         **********************************************************************/
        destroyTrainingUnit: function(id) {
            var url = '/api/scool/programming/training-units/' + id;
            axios.delete(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    toastr.warning(message, 'Warning'); // Notificar Error.
                } else {
                    this.indexTrainingUnits();          // Llistar (refrescar).
                    this.resetData();                   // Buidar camps.
                    $('#modal-delete').modal('hide');   // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        deleteModal: function(id) {
            this.showTrainingUnit(id);
            $('#modal-delete').modal('show'); // Obrir modal.
        },

        /**
         * STORE
         * POST => Rogerforner\ScoolProgramming\Http\Controllers\API\TrainingUnitController@store
         **********************************************************************/
        storeTrainingUnit: function() {
            var url = '/api/scool/programming/training-units';
            axios.post(url, {
                uf:                     this.form.createUf,
                name:                   this.form.createName,
                date_start:             this.form.createDateStart,
                date_end:               this.form.createDateEnd,
                section1:               this.form.createSection1,
                section2:               this.form.createSection2,
                section3:               this.form.createSection3,
                section4:               this.form.createSection4,
                professional_module_id: this.form.createPromodule,
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
                    this.indexTrainingUnits();          // Llistar (refrescar).
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
            this.form.createUf        = '';
            this.form.createName      = '';
            this.form.editDateStart   = '';
            this.form.editDateEnd     = '';
            this.form.createSection1  = '';
            this.form.createSection2  = '';
            this.form.createSection3  = '';
            this.form.createSection4  = '';
            this.form.createPromodule = '';
        },
        /**
         * UPDATE
         * UPDATE => Rogerforner\ScoolProgramming\Http\Controllers\API\TrainingUnitController@update
         **********************************************************************/
        updateTrainingUnit: function(id) {
            var url = '/api/scool/programming/training-units/' + id;
            axios.put(url, {
                uf:                     this.form.editUf,
                name:                   this.form.editName,
                date_start:             this.form.editDateStart,
                date_end:               this.form.editDateEnd,
                section1:               this.form.editSection1,
                section2:               this.form.editSection2,
                section3:               this.form.editSection3,
                section4:               this.form.editSection4,
                professional_module_id: this.form.editPromodule,
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
                    this.indexTrainingUnits();          // Llistar (refrescar).
                    this.resetData();                   // Buidar camps.
                    $('#modal-edit').modal('hide');     // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        editModal: function(id) {
            this.showTrainingUnit(id);

            this.form.editUf        = this.show.tunit.uf;
            this.form.editName      = this.show.tunit.name;
            this.form.editDateStart = this.show.tunit.date_start;
            this.form.editDateEnd   = this.show.tunit.date_end;
            this.form.editSection1  = this.show.tunit.section1;
            this.form.editSection2  = this.show.tunit.section2;
            this.form.editSection3  = this.show.tunit.section3;
            this.form.editSection4  = this.show.tunit.section4;
            this.form.editPromodule = this.show.tunit.professional_module_id;

            $('#modal-edit').modal('show'); // Obrir modal.
        },
        /**
         * APPROVE & DISAPPROVE
         * UPDATE => Rogerforner\ScoolProgramming\Http\Controllers\API\TrainingUnitController@update
         **********************************************************************/
        approveTrainingUnit: function(id, isApproved) {
            var url = '/api/scool/programming/training-units/' + id;
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
                    this.indexTrainingUnits();          // Llistar (refrescar).
                    $('#modal-approve').modal('hide');  // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        approveModal: function(id) {
            this.showTrainingUnit(id);
            $('#modal-approve').modal('show'); // Obrir modal.
        },
    }
});
</script>
