<template>
    <div>
        <b-modal id="viewDetails-modal" hide-footer hide-header >
            <header class="pt-2">
                <span class="h4">Job Application Details</span>
            </header>
            <hr>
            <div class="row pt-2">
                <div class="application-date pb-3">
                    <label class="form-label">Application Date</label>
                    <input type="date" class="form-control" v-model="job.application_date" disabled>
                </div>
                <div class="col-md-6 company-name">
                    <label class="form-label">Company Name</label>
                    <input class="form-control" type="text" v-model="job.company_name" disabled>
                </div>
                <div class="col-md-6 job-input">
                    <label class="form-label">Job Title</label>
                    <input class="form-control" type="text" v-model="job.job_title" disabled>
                </div>
                <div class="col-md-6 jobLoc-input pt-3">
                    <label class="form-label">Job Location</label>
                    <input class="form-control" type="text" v-model="job.job_location" disabled>
                </div>
                <div class="col-md-6 jobType-input pt-3">
                    <label class="form-label">Job Type</label>
                    <input class="form-control" type="text" v-model="job.job_type" disabled>
                </div>
                <div class="col-md-6 applicationPlatform-input pt-3">
                    <label class="form-label">Job Platform</label>
                    <select class="form-control" v-model="job.app_platform" disabled>
                        <option>Indeed</option>
                        <option>JobStreet</option>
                        <option>Facebook</option>
                        <option>Google</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="col-md-6 jobStatus-input pt-3">
                    <label class="form-label">Job Status</label>
                    <select class="form-control" v-model="job.job_status" disabled>
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
                <div class="col-md-12 jobDesc-input pt-3">
                    <label class="form-label">Job Description</label>
                    <textarea class="form-control" style="height: 50rem;" type="text" v-model="job.job_desc" disabled></textarea>
                </div>
            </div>
        </b-modal>
    </div>
</template>
<script>
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
}
</script>
