<div class="modal fade" id="modal-create" tabindex="-1" role="dialog"
     aria-labelledby="modalCreate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreate">
                    New Professional Module
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FORMULARI -->
            <form method="post" v-on:submit.prevent="storeProfessionalModule">
                <!-- Camps del formulari -->
                <div class="modal-body">
                    <!-- MP -->
                    <div class="form-group">
                        <label for="createMp">Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">MP</div>
                            </div>
                            <input type="number" min="1" id="createMp"
                                name="mp"
                                class="form-control" required
                                v-model="form.createMp">
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

                    <!-- Sections (navigation) -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="s1-tab"
                                data-toggle="tab" href="#s1"
                                role="tab" aria-controls="s1"
                                aria-selected="true">
                                S1 <i class="fas fa-check-circle text-success"
                                        v-if="form.createSection1"></i>
                                    <i class="fas fa-times-circle text-danger"
                                        v-else></i>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="s2-tab"
                                data-toggle="tab" href="#s2"
                                role="tab" aria-controls="s2"
                                aria-selected="false">
                                S2 <i class="fas fa-check-circle text-success"
                                        v-if="form.createSection2"></i>
                                    <i class="fas fa-times-circle text-danger"
                                        v-else></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="s3-tab"
                                data-toggle="tab" href="#s3"
                                role="tab" aria-controls="s3"
                                aria-selected="false">
                                S3 <i class="fas fa-check-circle text-success"
                                        v-if="form.createSection3"></i>
                                    <i class="fas fa-times-circle text-danger"
                                        v-else></i>
                            </a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" id="s4-tab"
                                    data-toggle="tab" href="#s4"
                                    role="tab" aria-controls="s4"
                                    aria-selected="false">
                                    S4 <i class="fas fa-check-circle text-success"
                                            v-if="form.createSection4"></i>
                                        <i class="fas fa-times-circle text-danger"
                                            v-else></i>
                                </a>
                            </li>
                    </ul>
                    <!-- Sections (content) -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Section 1 -->
                        <div class="tab-pane fade show active mt-2" id="s1" role="tabpanel" aria-labelledby="s1-tab">
                            <div class="form-group">
                                <label for="createSection1">Methodological strategies</label>
                                <textarea rows="3" id="createSection1"
                                    name="section1"
                                    class="form-control"
                                    v-model="form.createSection1"></textarea>
                            </div>
                        </div>
                        <!-- Section 2 -->
                        <div class="tab-pane fade mt-2" id="s2" role="tabpanel" aria-labelledby="s2-tab">
                            <div class="form-group">
                                <label for="createSection2">Evaluation criteria</label>
                                <textarea rows="3" id="createSection2"
                                    name="section2"
                                    class="form-control"
                                    v-model="form.createSection2"></textarea>
                            </div>
                        </div>
                        <!-- Section 3 -->
                        <div class="tab-pane fade mt-2" id="s3" role="tabpanel" aria-labelledby="s3-tab">
                            <div class="form-group">
                                <label for="createSection3">Resources</label>
                                <textarea rows="3" id="createSection3"
                                    name="section3"
                                    class="form-control"
                                    v-model="form.createSection3"></textarea>
                            </div>
                        </div>
                        <!-- Section 4 -->
                        <div class="tab-pane fade mt-2" id="s4" role="tabpanel" aria-labelledby="s4-tab">
                            <div class="form-group">
                                <label for="createSection4">Dual</label>
                                <textarea rows="3" id="createSection4"
                                    name="section4"
                                    class="form-control"
                                    v-model="form.createSection4"></textarea>
                            </div>
                        </div>
                    </div><!-- /.tab-content -->

                    <!-- Departament -->
                    <div class="form-group">
                        <label for="createDepartment">Department</label>
                        <select id="createDepartment"
                                name="department_id"
                                class="form-control" required
                                v-model="form.createDepartment">
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