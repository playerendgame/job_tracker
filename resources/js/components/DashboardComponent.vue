<template>
    <div class="div-container pb-5">
        <div class="container pt-5">
            <div class="row">
                <span class="display-6 text-start text-light pb-4"><B>Job Tracker</B></span>
            </div>
            <div class="row" style="align-items: center; backdrop-filter: blur(15px); padding: 1rem; border-radius: 5rem; border-style: solid; border-color: white;" >
                <div class="col-md-6">
                    <div class="profile-info d-flex ">
                        <img src="https://cdn-icons-png.flaticon.com/512/8847/8847419.png" class="img-fluid" style="width: 2rem;">
                        &nbsp; 
                        <span style="align-content: center;" class="text-light"><b>Hello {{ name }}!</b></span>
                        &nbsp; &nbsp;
                        <button class="btn btn-danger btn-sm" @click="logoutUser()">Logout</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="addJob-button d-flex justify-content-end">
                        <button class="btn btn-primary" @click="$bvModal.show('addJob-modal')">Add Job</button>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="row pt-4" style="backdrop-filter: blur(20px); padding: 2rem; border-radius: 2rem; border-style: solid; border-color: white">
                <div class="card" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 search-query">
                                <input type="search" v-model="searchQuery" placeholder="Search" class="form-control">
                             </div>
                        </div>
                        <div class="table table-responsive table-striped">
                            <table class="table" >
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
                                    <tr v-for="job in filteredJobs" :key="job.id">
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
                                             <button class="btn btn-sm btn-danger" @click="deleteJob(job.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination
                            v-model="currentPage"
                            :records="userJobs.length"
                            :per-page="perPage"
                            @paginate="paginate"
                            >
                            <button slot="prev">Previous</button>
                            <button slot="next">Next</button>
                        </Pagination>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer pt-5">
            <footer class="text-light text-center">
                <span class="h6">Made by playerendgame</span>
            </footer>
        </div>
        <job-modal-component />
        <update-job-component :v-if="selectedJob" :job="selectedJob" />
        <view-job-details-component v-if="selectedJob" :job="selectedJob" /> 
    </div>
</template>
<script>
import Swal from 'sweetalert2';
import Pagination from 'vue-pagination-2';
import axios from 'axios';

export default {
    data(){
        return {
            selectedJob: {},
            userJobs: [],
            jobs: [],
            loggedInUser: null,
            name: '',
            currentPage: 1,
            perPage: 5,
            searchQuery: '',
        }
    },
    components: {
        Pagination 
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
    computed: {
        filteredJobs() {
            const startIndex = (this.currentPage - 1) * this.perPage;
            const endIndex = startIndex + this.perPage;
            return this.userJobs.filter(job => {
            return (
                job.company_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                job.job_title.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
            }).slice(startIndex, endIndex);
        }
    },
    methods: {
        paginate(pageNumber) {
            this.currentPage = pageNumber;
        },
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
        },
        deleteJob(jobId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this job!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                axios.delete(`/delete/jobs/${jobId}`)
                .then(response => {
                    // handle success response
                    Swal.fire({
                    title: 'Deleted!',
                    text: 'Job has been deleted.',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                    })
                    this.fetchUserJobs(); // refresh the job list
                })
                .catch(error => {
                    // handle error response
                    console.error(error);
                });
                }
            })
            }
    }

}
</script>

<style>
.div-container{
  background-image: url('/images/background.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 100%;
  min-height: 100vh;
}
</style>

