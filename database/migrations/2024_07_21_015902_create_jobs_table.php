<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    // company_name: '',
    // job_title: '',
    // job_location: '',
    // job_type: '',
    // app_platform: '',
    // job_status: '',
    // job_desc: '',
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id'); // Add user_id column
            $table->foreign('user_id')->references('id')->on('users'); // Add foreign key constraint
            $table->date('application_date');
            $table->string('company_name');
            $table->string('job_title');
            $table->string('job_location');
            $table->string('job_type');
            $table->string('app_platform');
            $table->string('job_status');
            $table->longText('job_desc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
