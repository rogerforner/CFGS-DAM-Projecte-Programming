<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog"
     aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">
                    Edit Department
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FORMULARI -->
            <form method="post" v-on:submit.prevent="updateDepartment(show.department.id)">
                <!-- Camps del formulari -->
                <div class="modal-body">
                    <!-- Nom -->
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" id="editName"
                               name="name"
                               class="form-control" required
                               v-model="form.editName">
                        <div id="feedCreateName" class="invalid-feedback"></div>
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

                    <!-- Professors -->
                    <div class="form-group">
                        <label for="editSelectedTeachers">Teachers</label>
                        <select multiple id="editSelectedTeachers"
                                name="teachers"
                                class="form-control"
                                v-model="form.editSelectedTeachers">
                            <option v-for="user in index.users" :key="user.id"
                                    :value="user.id">
                                @{{ user.name }}
                            </option>
                        </select>
                        <div id="feedCreateTeachers" class="invalid-feedback"></div>
                    </div>

                    <!-- Cap de departament -->
                    <div class="form-group">
                        <label for="editDepartmentManager">Manager</label>
                        <select id="editDepartmentManager"
                                name="manager"
                                class="form-control" required
                                v-model="form.editDepartmentManager">
                            <option disabled value="">Select a department manager</option>
                            <option v-for="user in index.users" :key="user.id"
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
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->