<script>
import Pagination from '../PaginationComponent.vue';

new Vue({
    el: '#temariesCrud',
    created: function() {
        this.spinnerLoading = true;
        this.indexTemaries();
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
                temarieswp: [], // With pagination.
                temaries: [],
                tunits: [],
                userAuth: '',
            },
            show: {
                temary: '',
                temaryT: '',
            },
            form: {
                createNf: '',
                createDuration: '',
                createName: '',
                createDescription: '',
                createTunit: '',
                editNf: '',
                editDuration: '',
                editName: '',
                editDescription: '',
                editTunit: '',
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
            this.show.temary  = '';
            this.show.temaryT = '';

            this.form.createNf          = '';
            this.form.createDuration    = '';
            this.form.createName        = '';
            this.form.createDescription = '';
            this.form.createTunit       = '';

            this.form.editNf          = '';
            this.form.editDuration    = '';
            this.form.editName        = '';
            this.form.editDescription = '';
            this.form.editTunit       = '';
        },

        /**
         * INDEX Departaments
         * GET => Rogerforner\ScoolProgramming\Http\Controllers\API\TemaryController@index
         **********************************************************************/
        indexTemaries: function() {
            var url = '/api/scool/programming/temaries?temaries=' + this.pagination.current_page;
            axios.get(url).then(response => {
                this.index.temarieswp = response.data.apiResponseData.temarieswp.data;
                this.index.temaries   = response.data.apiResponseData.temaries;
                this.index.tunits     = response.data.apiResponseData.tunits;
                this.index.userAuth   = response.data.apiResponseData.userAuth;

                this.pagination = response.data.apiResponseData.pagination;
            });
        },

        /**
         * SHOW
         * GET => Rogerforner\ScoolProgramming\Http\Controllers\API\TemaryController@show
         **********************************************************************/
        showTemary: function(id) {
            var url = '/api/scool/programming/temaries/' + id;
            axios.get(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    console.log('Woops! ' + message);
                } else {
                    console.log('OK ' + message);
                }

                this.show.temary  = response.data.apiResponseData.temary;
                this.show.temaryT = response.data.apiResponseData.temaryT;
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        showModal: function(id) {
            this.showTemary(id);
            $('#modal-show').modal('show'); // Obrir modal.
        },

        /**
         * DESTROY
         * DELETE => Rogerforner\ScoolProgramming\Http\Controllers\API\TemaryController@destroy
         **********************************************************************/
        destroyTemary: function(id) {
            var url = '/api/scool/programming/temaries/' + id;
            axios.delete(url).then(response => {
                var success = response.data.success;
                var message = response.data.message;

                if (success == false) {
                    toastr.warning(message, 'Warning'); // Notificar Error.
                } else {
                    this.indexTemaries();               // Llistar (refrescar).
                    this.resetData();                   // Buidar camps.
                    $('#modal-delete').modal('hide');   // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        deleteModal: function(id) {
            this.showTemary(id);
            $('#modal-delete').modal('show'); // Obrir modal.
        },

        /**
         * STORE
         * POST => Rogerforner\ScoolProgramming\Http\Controllers\API\TemaryController@store
         **********************************************************************/
        storeTemary: function() {
            var url = '/api/scool/programming/temaries';
            axios.post(url, {
                nf:               this.form.createNf,
                duration:         this.form.createDuration,
                name:             this.form.createName,
                description:      this.form.createDescription,
                training_unit_id: this.form.createTunit,
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
                    this.indexTemaries();               // Llistar (refrescar).
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
            this.form.createNf          = '';
            this.form.createDuration    = '';
            this.form.createName        = '';
            this.form.createDescription = '';
            this.form.createTunit       = '';
        },
        /**
         * UPDATE
         * UPDATE => Rogerforner\ScoolProgramming\Http\Controllers\API\TemaryController@update
         **********************************************************************/
        updateTemary: function(id) {
            var url = '/api/scool/programming/temaries/' + id;
            axios.put(url, {
                nf:               this.form.editNf,
                duration:         this.form.editDuration,
                name:             this.form.editName,
                description:      this.form.editDescription,
                training_unit_id: this.form.editTunit,
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
                    this.indexTemaries();               // Llistar (refrescar).
                    this.resetData();                   // Buidar camps.
                    $('#modal-edit').modal('hide');     // Tancar modal.
                    toastr.success(message, 'Success'); // Notificar OK.
                }
            });
        },
        /* Modal
        --------------------------------------------------------------------- */
        editModal: function(id) {
            this.showTemary(id);

            this.form.editNf          = this.show.temary.nf;
            this.form.editDuration    = this.show.temary.duration;
            this.form.editName        = this.show.temary.name;
            this.form.editDescription = this.show.temary.description;
            this.form.editTunit       = this.show.temary.training_unit_id;

            $('#modal-edit').modal('show'); // Obrir modal.
        },
    }
});
</script>
