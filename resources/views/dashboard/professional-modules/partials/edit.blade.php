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
            <form method="post" v-on:submit.prevent="updateProfessionalModule(show.promodule.id)">
                <!-- Camps del formulari -->
                <div class="modal-body">
                    <!-- MP -->
                    <div class="form-group">
                        <label for="editMp">Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">MP</div>
                            </div>
                            <input type="number" min="1" id="editMp"
                                name="mp"
                                class="form-control" required
                                v-model="form.editMp">
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

                    <!-- Sections (navigation) -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="se1-tab"
                                data-toggle="tab" href="#se1"
                                role="tab" aria-controls="se1"
                                aria-selected="true">
                                S1 <i class="fas fa-check-circle text-success"
                                        v-if="form.editSection1"></i>
                                    <i class="fas fa-times-circle text-danger"
                                        v-else></i>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="se2-tab"
                                data-toggle="tab" href="#se2"
                                role="tab" aria-controls="se2"
                                aria-selected="false">
                                S2 <i class="fas fa-check-circle text-success"
                                        v-if="form.editSection2"></i>
                                    <i class="fas fa-times-circle text-danger"
                                        v-else></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="se3-tab"
                                data-toggle="tab" href="#se3"
                                role="tab" aria-controls="se3"
                                aria-selected="false">
                                S3 <i class="fas fa-check-circle text-success"
                                        v-if="form.editSection3"></i>
                                    <i class="fas fa-times-circle text-danger"
                                        v-else></i>
                            </a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" id="se4-tab"
                                    data-toggle="tab" href="#se4"
                                    role="tab" aria-controls="se4"
                                    aria-selected="false">
                                    S4 <i class="fas fa-check-circle text-success"
                                            v-if="form.editSection4"></i>
                                        <i class="fas fa-times-circle text-danger"
                                            v-else></i>
                                </a>
                            </li>
                    </ul>
                    <!-- Sections (content) -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Section 1 -->
                        <div class="tab-pane fade show active mt-2" id="se1" role="tabpanel" aria-labelledby="se1-tab">
                            <div class="form-group">
                                <label for="editSection1">Methodological strategies</label>
                                <textarea rows="3" id="editSection1"
                                    name="section1"
                                    class="form-control"
                                    v-model="form.editSection1"></textarea>
                            </div>
                        </div>
                        <!-- Section 2 -->
                        <div class="tab-pane fade mt-2" id="se2" role="tabpanel" aria-labelledby="se2-tab">
                            <div class="form-group">
                                <label for="editSection2">Evaluation criteria</label>
                                <textarea rows="3" id="editSection2"
                                    name="section2"
                                    class="form-control"
                                    v-model="form.editSection2"></textarea>
                            </div>
                        </div>
                        <!-- Section 3 -->
                        <div class="tab-pane fade mt-2" id="se3" role="tabpanel" aria-labelledby="se3-tab">
                            <div class="form-group">
                                <label for="editSection3">Resources</label>
                                <textarea rows="3" id="editSection3"
                                    name="section3"
                                    class="form-control"
                                    v-model="form.editSection3"></textarea>
                            </div>
                        </div>
                        <!-- Section 4 -->
                        <div class="tab-pane fade mt-2" id="se4" role="tabpanel" aria-labelledby="se4-tab">
                            <div class="form-group">
                                <label for="editSection4">Dual</label>
                                <textarea rows="3" id="editSection4"
                                    name="section4"
                                    class="form-control"
                                    v-model="form.editSection4"></textarea>
                            </div>
                        </div>
                    </div><!-- /.tab-content -->

                    <!-- Departament -->
                    <div class="form-group">
                        <label for="editDepartment">Department</label>
                        <select id="editDepartment"
                                name="department_id"
                                class="form-control" required
                                v-model="form.editDepartment">
                            <option disabled value="">Select a department</option>
                            <option v-for="department in index.departments" :key="department.id"
                                    :value="department.id">
                                @{{ department.name }}
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