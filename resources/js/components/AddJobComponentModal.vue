<template>
    <div>
        <b-modal id="addJob-modal" hide-footer hide-header>
            <header class="pt-2">
                <span class="h4">Add Job Information</span>
            </header>
            <hr>
            <div class="row pt-2">
                <div class="company-name">
                    <input class="form-control" type="text" placeholder="Enter Company Name" v-model="company_name">
                </div>
                <div class="job-input pt-4">
                    <input class="form-control" type="text" placeholder="Enter Job Title" v-model="job_title">
                </div>
                <div class="jobLoc-input pt-4">
                    <input class="form-control" type="text" placeholder="Enter Location" v-model="job_location">
                </div>
                <div class="jobType-input pt-4">
                    <input class="form-control" type="text" placeholder="Enter Job Type" v-model="job_type">
                </div>
                <div class="jobStatus-input pt-4">
                    <select class="form-control">
                        <option>Waiting For Feedback</option>
                    </select>
                </div>
                <div class="jobDesc-input pt-4">
                    <textarea class="form-control" type="text" placeholder="Enter Job Description" v-model="job_desc"></textarea>
                </div>
                <div class="buttons pt-4">
                    <button class="btn btn-success" @click.prevent="submitForm">Sign In</button>
                </div>
            </div>
        </b-modal>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default {

}
</script>