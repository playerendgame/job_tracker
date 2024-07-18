<template>
    <div>
        <div class="container pt-5">
            <div class="row">
                <span class="display-4 text-center">Job Tracker</span>
            </div>
            <div class="row" style="align-items: center;">
                <div class="col-md-6">
                    <div class="profile-info d-flex ">
                        <img src="https://cdn-icons-png.flaticon.com/512/8847/8847419.png" class="img-fluid" style="width: 2rem;">
                        &nbsp; 
                        <span style="align-content: center;"><b>Hello Clyde Timothy</b></span>
                        &nbsp; &nbsp;
                        <button class="btn btn-danger btn-sm" @click="logoutUser()">Logout</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="addJob-button d-flex justify-content-end">
                        <button class="btn btn-success" @click="$bvModal.show('addJob-modal')">Add Job</button>
                    </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table table-responsive table-striped">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Company Name</th>
                                        <th>Job Title</th>
                                        <th>Job Location</th>
                                        <th>Job Type</th>
                                        <th>Job Description</th>
                                        <th>Application Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <job-modal-component />
    </div>
</template>
<script>
export default {

    methods: {
        logoutUser() {
            axios.post('/logout', {})
            .then(response => {
                window.location.href = '/';
            })
            .catch(error => {
                console.error(error);
            });
        }
    }

}
</script>