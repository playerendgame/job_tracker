<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Jobs;

class JobsController extends Controller
{
    public function store(Request $request){

        $validatedData = $request->validate([
            'application_date' => 'required',
            'company_name' => 'required',
            'job_title' => 'required',
            'job_location' => 'required',
            'job_type' => 'required',
            'app_platform' => 'required',
            'job_status' => 'required',
            'job_desc' => 'required',
        ]);
        
        $job = new Jobs();
        $job->user_id = auth()->id();
        $job->application_date = Carbon::parse($validatedData['application_date'])->format('Y-m-d H:i:s');        
        $job->company_name = $validatedData['company_name'];
        $job->job_title = $validatedData['job_title'];
        $job->job_location = $validatedData['job_location'];
        $job->job_type = $validatedData['job_type'];
        $job->app_platform = $validatedData['app_platform'];
        $job->job_status = $validatedData['job_status'];
        $job->job_desc = $validatedData['job_desc'];
        $job->save();
        
        return response()->json(['message' => 'Job created successfully!', 'status' => 201]);
        
    }

    public function getUserJobs(){

        $jobs = Jobs::where('user_id', auth()->id())->get(); // Only retrieve jobs for the current user
        return response()->json($jobs);
    }


    public function update(Request $request, $id)
    {
        $job = Jobs::findOrFail($id);
    
        foreach ($request->all() as $field => $value) {
            if (!empty($value)) {
                $job->$field = $value;
            }
        }
        $job->save();
    
        return response()->json(['message' => 'Job updated successfully!']);
    }


    public function delete($id){

        $job = Jobs::findOrFail($id);
        $job->delete();

        return response()->json(['message' => 'Job Deleted Successfully']);

    }
    
    
    
}
