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
                        <span style="align-content: center;"><b>Hello {{ name }}!</b></span>
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
                                        <th></th>
                                        <th>Date Created</th>
                                        <th>Application Date</th>
                                        <th>Company Name</th>
                                        <th>Job Title</th>
                                        <th>Job Location</th>
                                        <th>Job Type</th>
                                        <th>Platform</th>
                                        <th>Application Status</th>     
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="job in userJobs" :key="job.id">
                                        <td>
                                            <button class="btn btn-sm btn-success" @click="$bvModal.show('viewDetails-modal', { job: job }); selectJob(job)">View Details</button>
                                        </td>
                                        <td>{{ job.created_at | formatDate }}</td>
                                        <td> {{ job.application_date | formatDate }}</td>
                                        <td>{{ job.company_name }}</td>
                                        <td>{{ job.job_title }}</td>
                                        <td>{{ job.job_location }}</td>
                                        <td>{{ job.job_type }}</td>
                                        <td>{{ job.app_platform }}</td>
                                        <td>{{ job.job_status }}</td>
                                        <td class="d-flex justify-content-center">
                                            <button class="btn btn-sm btn-success" @click="$bvModal.show('updateJob-modal', { job: job }); selectJob(job)">Update</button>
                                             &nbsp; &nbsp;
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <job-modal-component />
        <update-job-component :v-if="selectedJob" :job="selectedJob" />
        <view-job-details-component v-if="selectedJob" :job="selectedJob" />
        
    </div>
</template>
<script>
export default {
    data(){
        return {
            selectedJob: {},
            userJobs: [],
            jobs: [],
            loggedInUser: null,
            name: ''
        }
    },
    mounted() {
        this.fetchUserJobs();
        this.fetchLoggedInUser();
    },
    filters: {
        formatDate(value) {
            const date = new Date(value);
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            return `${days[date.getDay()]}, ${months[date.getMonth()]} ${date.getDate()}, ${date.getFullYear()} at ${date.getHours() % 12 || 12}:${date.getMinutes().toString().padStart(2, '0')} ${date.getHours() >= 12 ? 'PM' : 'AM'}`;
        }
    },
    methods: {
        fetchUserJobs() {
            axios.get('/fetch/user/jobs')
                .then(response => {
                this.userJobs = response.data;
                })
                .catch(error => {
                console.error(error);
                });
            },
            selectJob(job) {
                this.selectedJob = job;
            },
            logoutUser() {
                axios.post('/logout', {})
                .then(response => {
                    window.location.href = '/';
                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchLoggedInUser(){
            axios.get('/fetch/loggedin/user')
            .then(response => {
                this.loggedInUser = response.data;
                this.name = response.data.user; 
            })
            .catch(error => {
                console.error(error);
            });
        }
    }

}
</script>