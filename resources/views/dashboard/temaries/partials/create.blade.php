<div class="modal fade" id="modal-create" tabindex="-1" role="dialog"
     aria-labelledby="modalCreate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreate">
                    New Temary
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FORMULARI -->
            <form method="post" v-on:submit.prevent="storeTemary">
                <!-- Camps del formulari -->
                <div class="modal-body">
                    <!-- NF -->
                    <div class="form-group">
                        <label for="createNf">Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">NF</div>
                            </div>
                            <input type="number" min="1" id="createNf"
                                   name="nf"
                                   class="form-control" required
                                   v-model="form.createNf">
                        </div><!-- /.input-group -->
                    </div>

                    <!-- Duració -->
                    <div class="form-group">
                        <label for="createDuration">Duration</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">h</div>
                            </div>
                            <input type="number" min="1" id="createDuration"
                                   name="duration"
                                   class="form-control" required
                                   v-model="form.createDuration">
                        </div><!-- /.input-group -->
                    </div>

                    <!-- Nom -->
                    <div class="form-group">
                        <label for="createName">Name</label>
                        <input type="text" id="createName"
                               name="name"
                               class="form-control" required
                               v-model="form.createName">
                    </div>

                    <!-- Descripció -->
                    <div class="form-group">
                        <label for="createDescription">Description</label>
                        <textarea rows="3" id="createDescription"
                                  name="description"
                                  class="form-control"
                                  v-model="form.createDescription"></textarea>
                        <div id="feedCreateDescription" class="invalid-feedback"></div>
                    </div>

                    <!-- Training Units -->
                    <div class="form-group">
                        <label for="createTunit">Training Unit</label>
                        <select id="createTunit"
                                name="training_unit_id"
                                class="form-control" required
                                v-model="form.createTunit">
                            <option disabled value="">Select a training unit</option>
                            <option v-for="tunit in index.tunits" :key="tunit.id"
                                    :value="tunit.id"
                                    v-if="index.userAuth.email == tunit.created_by">
                                @{{ tunit.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Botons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-warning"
                            @click.prevent="resetCreateForm()">
                        Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->