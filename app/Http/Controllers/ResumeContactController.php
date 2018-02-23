<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResumeContact;
use Auth;

class ResumeContactController extends Controller
{
    public function store(Request $request, $resume_id)
    {
        $resume_contact = ResumeContact::firstOrCreate(
            ['resume_id' => $resume_id], ['user_id' => Auth::id()]
        );
        if ($resume_contact->user_id == Auth::id()) {
            if (ResumeContact::where('email', $request->input('email'))->where('user_id', '!=', $resume_contact->user_id)->count() == 0) {
                $resume_contact->updateModel($request->except('_token'));
            } else {
                echo 3;
            }
        } else {
            echo 0;
        }
    }
}
