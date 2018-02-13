<?php

namespace App\Http\Controllers;

use App\Resume;
use App\City;
use Illuminate\Http\Request;
use Auth;
use Jenssegers\Date\Date;

class ResumeController extends Controller
{

    public function __construct() {
        $this->middleware("auth");
        Date::setLocale(app()->getLocale());
    }

    public function index()
    {
        $cities = City::all();
        $user_resumes = Auth::user()->resumes;
        return view('resume.list', compact('cities', 'user_resumes'));
    }

    public function store(Request $request)
    {
        $resume = new Resume();
        $resume->user_id = Auth::id();
        $resume->name = $request->input('name');
        $resume->language = $request->input('language');
        $resume->save();
        echo $resume->id;
    }

    public function edit($resume_id)
    {
        $cities = City::all();        
        $resume = Resume::findOrFail($resume_id);
        if ($resume->user->id == Auth::id()) {
            return view('resume.edit', compact('cities', 'resume'));
        } else {
            generate_flash("error", __("commons.no_access_to_resume"));
            return redirect('resumes');
        }
    }

    public function destroy($resume_id)
    {
        if (Resume::find($resume_id)->user->id == Auth::id()) {
            Resume::find($resume_id)->delete();
            echo Resume::where('user_id', Auth::id())->count();
        } else {
            echo -1;
        }
    }

    public function change_resume_status($resume_id) {
        if (Resume::find($resume_id)->user->id == Auth::id()) {
            Resume::find($resume_id)->toggleStatus();
            echo Resume::find($resume_id)->toJson();
        } else {
            echo 0;
        }
    }

    public function update_resume_date($resume_id) {
        if (Resume::find($resume_id)->user->id == Auth::id()) {
            Resume::find($resume_id)->justUpdate();
            echo 1;
        } else {
            echo 0;
        }
    }

    public function change_resume_privacy(Request $request, $resume_id) {
        if (Resume::find($resume_id)->user->id == Auth::id()) {
            Resume::find($resume_id)->updatePrivacy($request->input("selected"));
            echo 1;
        } else {
            echo 0;
        }
    }
}
