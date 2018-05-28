<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog"
     aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">
                    Edit Temary
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FORMULARI -->
            <form method="post" v-on:submit.prevent="updateTemary(show.temary.id)">
                <!-- Camps del formulari -->
                <div class="modal-body">
                    <!-- NF -->
                    <div class="form-group">
                        <label for="editNf">Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">NF</div>
                            </div>
                            <input type="number" min="1" id="editNf"
                                    name="nf"
                                    class="form-control" required
                                    v-model="form.editNf">
                        </div><!-- /.input-group -->
                    </div>

                    <!-- Duració -->
                    <div class="form-group">
                        <label for="editDuration">Duration</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">h</div>
                            </div>
                            <input type="number" min="1" id="editDuration"
                                    name="duration"
                                    class="form-control" required
                                    v-model="form.editDuration">
                        </div><!-- /.input-group -->
                    </div>

                    <!-- Nom -->
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" id="editName"
                                name="name"
                                class="form-control" required
                                v-model="form.editName">
                    </div>

                    <!-- Descripció -->
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea rows="3" id="editDescription"
                                  name="description"
                                  class="form-control"
                                  v-model="form.editDescription"></textarea>
                        <div id="feedCreateDescription" class="invalid-feedback"></div>
                    </div>

                    <!-- Training Units -->
                    <div class="form-group">
                        <label for="editTunit">Training Unit</label>
                        <select id="editTunit"
                                name="training_unit_id"
                                class="form-control" required
                                v-model="form.editTunit">
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
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->