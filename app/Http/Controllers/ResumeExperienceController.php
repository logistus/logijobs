<?php

namespace App\Http\Controllers;

use App\ResumeExperience;
use Illuminate\Http\Request;
use Auth;
use App\Country;
use App\City;
use App\WorkType;

class ResumeExperienceController extends Controller
{
    public function store(Request $request) {
        $experience = new ResumeExperience();
        $experience->user_id = Auth::id();
        $experience->resume_id = $request->input('resume_id');
        $experience->job_title = $request->input('job_title');
        $experience->company_name = $request->input('company_name');
        $experience->job_description = $request->input('job_description');
        $experience->start_date = $request->input('start_date');
        $experience->still_working = $request->input('still_working');
        if (!$request->input('still_working'))
            $experience->end_date = $request->input('end_date');
        $experience->country_id = $request->input('job_country');
        $experience->city_id = $request->input('job_city');
        $experience->work_type = $request->input('work_type');
        $experience->save();
        echo 1;
    }

    public function delete($experience_id) {
        ResumeExperience::find($experience_id)->delete();
        echo 1;
    }

    public function get_details($experience_id) {
        echo ResumeExperience::find($experience_id)->toJson();
    }

    public function edit(Request $request, $experience_id) {
        $experience = ResumeExperience::find($experience_id);
        $experience->job_title = $request->input('job_title');
        $experience->company_name = $request->input('company_name');
        $experience->job_description = $request->input('job_description');
        $experience->start_date = $request->input('start_date');
        $experience->still_working = $request->input('still_working');
        if (!$request->input('still_working'))
            $experience->end_date = $request->input('end_date');
        $experience->country_id = $request->input('job_country');
        $experience->city_id = $request->input('job_city');
        $experience->work_type = $request->input('work_type');
        $experience->save();
        echo 1;
    }
}
