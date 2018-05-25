<div class="modal fade" id="modal-create" tabindex="-1" role="dialog"
     aria-labelledby="modalCreate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreate">
                    New Department
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FORMULARI -->
            <form method="post" v-on:submit.prevent="storeDepartment">
                <!-- Camps del formulari -->
                <div class="modal-body">
                    <!-- Nom -->
                    <div class="form-group">
                        <label for="createName">Name</label>
                        <input type="text" id="createName"
                               name="name"
                               class="form-control" required
                               v-model="createName">
                        <div id="feedCreateName" class="invalid-feedback"></div>
                    </div>

                    <!-- Descripció -->
                    <div class="form-group">
                        <label for="createDescription">Description</label>
                        <textarea rows="3" id="createDescription"
                                  name="description"
                                  class="form-control"
                                  v-model="createDescription"></textarea>
                        <div id="feedCreateDescription" class="invalid-feedback"></div>
                    </div>

                    <!-- Professors -->
                    <div class="form-group">
                        <label for="createSelectedTeachers">Teachers</label>
                        <select multiple id="createSelectedTeachers"
                                class="form-control"
                                v-model="createSelectedTeachers">
                            <option v-for="user in users" :key="user.id"
                                    :value="user.id">
                                @{{ user.name }}
                            </option>
                        </select>
                        <div id="feedCreateTeachers" class="invalid-feedback"></div>
                    </div>

                    <!-- Cap de departament -->
                    <div class="form-group">
                        <label for="createDepartmentManager">Manager</label>
                        <select id="createDepartmentManager"
                                class="form-control"
                                v-model="createDepartmentManager">
                            <option disabled value="">Select a department manager</option>
                            <option v-for="user in users" :key="user.id"
                                    :value="user.id">
                                @{{ user.name }}
                            </option>
                        </select>
                        <div id="feedDepartmentManager" class="invalid-feedback"></div>
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