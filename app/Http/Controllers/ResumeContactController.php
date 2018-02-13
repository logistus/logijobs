<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResumeContact;
use Auth;

class ResumeContactController extends Controller
{
    public function store(Request $request, $resume_id)
    {
        $resume_contact = ResumeContact::firstOrCreate(['resume_id' => $resume_id]);
        if ($resume_contact->resume->user->id == Auth::id()) {
            $resume_contact->updateModel($request->except('_token'));
            echo 1;
        } else {
            echo 0;
        }
    }
}
