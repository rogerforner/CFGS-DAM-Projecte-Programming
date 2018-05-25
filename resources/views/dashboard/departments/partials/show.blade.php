<div class="modal fade" id="modal-show" tabindex="-1" role="dialog"
     aria-labelledby="modalShow" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShow">
                    @{{ show.department.name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- COS -->
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Information</h6>
                        <p>@{{ show.department.description }}</p>
                        <!-- Professors i Moduls Professionals -->
                        <div class="accordion" id="accordionDepartment">
                            <!-- Professors -->
                            <div class="card">
                                <div class="card-header" id="departmentTeachers">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseDepartmentTeachers"
                                                aria-expanded="true"
                                                aria-controls="collapseOne">
                                            <span class="badge badge-primary">@{{ show.departmentUs.length }}</span> Teachers
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseDepartmentTeachers"
                                     class="collapse show"
                                     aria-labelledby="departmentTeachers"
                                     data-parent="#accordionDepartment">
                                    <div class="card-body">
                                        <p class="text-center">
                                            <strong>@{{ show.departmentM.name }}</strong><br>
                                            <span class="text-muted">@{{ show.departmentM.email }}</span>
                                        </p><hr>
                                        <ul>
                                            <span v-if="show.departmentUs.length == 0"
                                                  class="text-muted">
                                                <small>No data yet.</small>
                                            </span>
                                            <li v-for="teacher in show.departmentUs"
                                                :key="teacher.id">
                                                @{{ teacher.name }}
                                                <hr>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Moduls Professionals -->
                            <div class="card">
                                <div class="card-header" id="departmentProfessionalModules">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseDepartmentProfessionalModules"
                                                aria-expanded="true"
                                                aria-controls="collapseOne">
                                            <span class="badge badge-primary">@{{ show.departmentMP.length }}</span> Professional Modules
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseDepartmentProfessionalModules"
                                        class="collapse"
                                        aria-labelledby="departmentProfessionalModules"
                                        data-parent="#accordionDepartment">
                                    <div class="card-body">
                                        <ul>
                                            <span v-if="show.departmentMP.length == 0"
                                                  class="text-muted">
                                                <small>No data yet.</small>
                                            </span>
                                            <li v-for="professionalModule in show.departmentMP"
                                                :key="professionalModule.id">
                                                @{{ professionalModule.name }}
                                                <hr>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.accordion -->
                    </div>
                </div><!-- /.card -->
            </div>

            <!-- Botons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->