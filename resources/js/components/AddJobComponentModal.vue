<template>
    <div>
        <b-modal id="addJob-modal" hide-footer hide-header>
            <header class="pt-2">
                <span class="h4">Add Job Information</span>
            </header>
            <hr>
            <div class="row pt-2">
                <div class="application-date">
                    <label class="form-label">Application Date</label>
                    <input class="form-control" type="date" v-model="application_date">
                </div>
                <div class="company-name pt-4">
                    <label class="form-label">Company Name</label>
                    <input class="form-control" type="text" placeholder="Enter Company Name" v-model="company_name">
                </div>
                <div class="job-input pt-4">
                    <label class="form-label">Job Title</label>
                    <input class="form-control" type="text" placeholder="Enter Job Title" v-model="job_title">
                </div>
                <div class="jobLoc-input pt-4">
                    <label class="form-label">Job Location</label>
                    <input class="form-control" type="text" placeholder="Enter Location" v-model="job_location">
                </div>
                <div class="jobType-input pt-4">
                    <label class="form-label">Job Type</label>
                    <input class="form-control" type="text" placeholder="Enter Job Type" v-model="job_type">
                </div>
                <div class="applicationPlatform-input pt-4">
                    <label class="form-label">Platform</label>
                    <select class="form-control" v-model="app_platform">
                        <option>Indeed</option>
                        <option>JobStreet</option>
                        <option>Facebook</option>
                        <option>Google</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="jobStatus-input pt-4">
                    <label class="form-label">Status</label>
                    <select class="form-control" v-model="job_status">
                        <option>Waiting For Feedback</option>
                        <option>Application Seen</option>
                        <option>Scheduled For Interview</option>
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
                    <textarea class="form-control" type="text" placeholder="Enter Job Description" v-model="job_desc"></textarea>
                </div>
                <div class="buttons pt-4">
                    <button class="btn btn-success" @click.prevent="submitForm">Add Job</button>
                </div>
            </div>
        </b-modal>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default {

    data(){
        return {
            company_name: '',
            job_title: '',
            job_location: '',
            job_type: '',
            app_platform: 'Indeed',
            job_status: 'Waiting For Feedback',
            job_desc: '',
        }
    },
    methods: {
    submitForm() {
      axios.post('/api/jobs', {
        application_date: new Date(),
        company_name: this.company_name,
        job_title: this.job_title,
        job_location: this.job_location,
        job_type: this.job_type,
        app_platform: this.app_platform,
        job_status: this.job_status,
        job_desc: this.job_desc
      })
      .then(response => {
        // handle success response
        Swal.fire({
            title: 'Success!',
            text: 'Job Added Successfully',
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