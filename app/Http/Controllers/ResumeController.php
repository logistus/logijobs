<?php

namespace App\Http\Controllers;

use App\Resume;
use Illuminate\Http\Request;
use Auth;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function show(Resume $resume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resume $resume)
    {
        //
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
}
