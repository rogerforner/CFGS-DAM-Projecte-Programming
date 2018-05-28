<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog"
     aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit">
                    Edit Training Unit
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FORMULARI -->
            <form method="post" v-on:submit.prevent="updateTrainingUnit(show.tunit.id)">
                <!-- Camps del formulari -->
                <div class="modal-body">
                    <!-- UF -->
                    <div class="form-group">
                        <label for="editUf">Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">UF</div>
                            </div>
                            <input type="number" min="1" id="editUf"
                                    name="mp"
                                    class="form-control" required
                                    v-model="form.editUf">
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

                    <!-- Date Start/End -->
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="editDateStart">Date Start</label>
                                <input type="date" id="editDateStart"
                                        name="date_start"
                                        class="form-control" required
                                        v-model="form.editDateStart">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="editDateEnd">Date End</label>
                                <input type="date" id="editDateEnd"
                                        name="date_end"
                                        class="form-control" required
                                        v-model="form.editDateEnd">
                            </div>
                        </div>
                    </div>

                    <!-- Sections (navigation) -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="es1-tab"
                                data-toggle="tab" href="#es1"
                                role="tab" aria-controls="es1"
                                aria-selected="true">
                                S1 <i class="fas fa-check-circle text-success"
                                        v-if="form.editSection1"></i>
                                    <i class="fas fa-times-circle text-danger"
                                        v-else></i>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="es2-tab"
                                data-toggle="tab" href="#es2"
                                role="tab" aria-controls="es2"
                                aria-selected="false">
                                S2 <i class="fas fa-check-circle text-success"
                                        v-if="form.editSection2"></i>
                                    <i class="fas fa-times-circle text-danger"
                                        v-else></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="es3-tab"
                                data-toggle="tab" href="#es3"
                                role="tab" aria-controls="es3"
                                aria-selected="false">
                                S3 <i class="fas fa-check-circle text-success"
                                        v-if="form.editSection3"></i>
                                    <i class="fas fa-times-circle text-danger"
                                        v-else></i>
                            </a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" id="es4-tab"
                                    data-toggle="tab" href="#es4"
                                    role="tab" aria-controls="es4"
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
                        <div class="tab-pane fade show active mt-2" id="es1" role="tabpanel" aria-labelledby="es1-tab">
                            <div class="form-group">
                                <label for="editSection1">Activities</label>
                                <textarea rows="3" id="editSection1"
                                    name="section1"
                                    class="form-control"
                                    v-model="form.editSection1"></textarea>
                            </div>
                        </div>
                        <!-- Section 2 -->
                        <div class="tab-pane fade mt-2" id="es2" role="tabpanel" aria-labelledby="es2-tab">
                            <div class="form-group">
                                <label for="editSection2">Learning outcomes and evaluation criteria</label>
                                <textarea rows="3" id="editSection2"
                                    name="section2"
                                    class="form-control"
                                    v-model="form.editSection2"></textarea>
                            </div>
                        </div>
                        <!-- Section 3 -->
                        <div class="tab-pane fade mt-2" id="es3" role="tabpanel" aria-labelledby="es3-tab">
                            <div class="form-group">
                                <label for="editSection3">Contents</label>
                                <textarea rows="3" id="editSection3"
                                    name="section3"
                                    class="form-control"
                                    v-model="form.editSection3"></textarea>
                            </div>
                        </div>
                        <!-- Section 4 -->
                        <div class="tab-pane fade mt-2" id="es4" role="tabpanel" aria-labelledby="es4-tab">
                            <div class="form-group">
                                <label for="editSection4">Evaluation criteria</label>
                                <textarea rows="3" id="editSection4"
                                    name="section4"
                                    class="form-control"
                                    v-model="form.editSection4"></textarea>
                            </div>
                        </div>
                    </div><!-- /.tab-content -->

                    <!-- Professional Modules -->
                    <div class="form-group">
                        <label for="editPromodule">Professional Module</label>
                        <select id="editPromodule"
                                name="professional_module_id"
                                class="form-control" required
                                v-model="form.editPromodule">
                            <option disabled value="">Select a professional module</option>
                            <option v-for="promodule in index.promodules" :key="promodule.id"
                                    :value="promodule.id"
                                    v-if="index.userAuth.email == promodule.created_by">
                                M@{{ promodule.mp }}, @{{ promodule.name }}
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