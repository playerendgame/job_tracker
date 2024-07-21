<template>
    <div>
        <b-modal id="updateJob-modal" hide-footer hide-header>
            <header class="pt-2">
                <span class="h4">Update Job Information</span>
            </header>
            <hr>
            <div class="row pt-2">
                <div class="application-date">
                    <label class="form-label">Application Date</label>
                    <input class="form-control" type="date" v-model="job.application_date">
                </div>
                <div class="company-name pt-4">
                    <label class="form-label">Company Name</label>
                    <input class="form-control" type="text" v-model="job.company_name">
                </div>
                <div class="job-input pt-4">
                    <label class="form-label">Job Title</label>
                    <input class="form-control" type="text" v-model="job.job_title">
                </div>
                <div class="jobLoc-input pt-4">
                    <label class="form-label">Job Location</label>
                    <input class="form-control" type="text" v-model="job.job_location">
                </div>
                <div class="jobType-input pt-4">
                    <label class="form-label">Job Type</label>
                    <input class="form-control" type="text" v-model="job.job_type">
                </div>
                <div class="applicationPlatform-input pt-4">
                    <label class="form-label">Platform</label>
                    <select class="form-control" v-model="job.app_platform">
                        <option>Indeed</option>
                        <option>JobStreet</option>
                        <option>Facebook</option>
                        <option>Google</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="jobStatus-input pt-4">
                    <label class="form-label">Job Status</label>
                    <select class="form-control" v-model="job.job_status">
                        <option>Waiting For Feedback</option>
                        <option>Application Seen</option>
                        <option>Scheduled For Interview</option>
                        <option>Scheduled For Assessment / Exam</option>
                        <option>Assessment / Exam Done</option>
                        <option>1st Interview Done</option>
                        <option>2nd Interview Done</option>
                        <option>3rd Interview Done</option>
                        <option>Final Interview Done</option>
                        <option>Rejected</option>
                        <option>Job Offered</option>
                        <option>Hired</option>
                    </select>
                </div>
                <div class="jobDesc-input pt-4">
                    <label class="form-label">Job Description</label>
                    <textarea class="form-control" type="text" v-model="job.job_desc"></textarea>
                </div>
                <div class="buttons pt-4">
                    <button class="btn btn-success" @click.prevent="updateForm">Save Changes</button>
                </div>
            </div>
        </b-modal>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default {

    props: {
        job: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
            formData: {
                application_date: '',
                company_name: '',
                job_title: '',
                job_location: '',
                job_type: '',
                app_platform: '',
                job_status: '',
                job_desc: '',
            }
        }
    },
    methods: {
        updateForm() {
            axios.post('/update/jobs/' + this.job.id, this.job)
            .then(response => {
                // handle success response
                Swal.fire({
                title: 'Success!',
                text: 'Job Updated Successfully!',
                icon: 'success',
                confirmButtonText: 'Okay'
                })
                return
            })
            .catch(error => {
                // handle error response
                console.error(error);
            });
            }

    }

}
</script>
