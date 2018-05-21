<template>
    <div class="container-fluid">
        <!-- TÍTOL + AFEGIR -->
        <div class="row">
            <div class="col-md-9">
                <h5 class="card-title">Users</h5>
            </div>
            <div class="col-md-3">
                <a class="btn btn-primary btn-block" href="#" role="button">New User</a>
            </div>
        </div><!-- /.row -->
        <!-- LLISTA DE DEPARTAMENTS -->
        <div class="row mt-5">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Name</th>
                            <th scope="col">eMmail</th>
                            <th scope="col">Provider</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" :key="user.id">
                            <th scope="row">{{ ++index }}</th>
                            <td>
                                <img :src="user.avatar"
                                        class="rounded rounded-circle"
                                        height="44px" alt="userName"
                                        v-if="user.avatar">
                            </td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.provider }}</td>
                            <td>
                                <button type="button" class="btn btn-primary"
                                tooltip="tooltip" data-placement="top" title="See">
                                    <i class="far fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-dark"
                                tooltip="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-danger"
                                tooltip="tooltip" data-placement="top" title="Delete"
                                @click.prevent="deleteUser(user)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.row -->

        <!-- MODAL: DELETE -->
        <!-- Access Token Modal -->
        <div class="modal fade" id="modal-delete-user" tabindex="-1" role="dialog"
             aria-labelledby="modalDeleteUser" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteUser">Delete user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Are you sure to delete the user?</strong>,<br>
                        This action is irreversible, you will not be able to recover the data.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->
    </div><!-- /.container-fluid -->
</template>

<script>
export default {
    created: function() {
        this.getUsers();
    },
    data: function() {
        return {
            users: []
        }
    },
    methods: {
        // GET => API\UserController@index
        getUsers: function() {
            var url = '/api/users';
            axios.get(url).then(response => {
                this.users = response.data;
            });
        },
        // DELETE => API\UserController@destroy
        deleteUser: function(user) {
            var url = '/api/users/' + user.id;
            axios.delete(url).then(response => {
                this.getUsers(); // Per refrescar el llistat d'usuaris.
            });
        }
    }
}
</script>
