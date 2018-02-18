<?php

namespace App\Policies;

use App\User;
use App\Resume;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResumeEditPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the resume.
     *
     * @param  \App\User  $user
     * @param  \App\Resume  $resume
     * @return mixed
     */
    public function view(User $user, Resume $resume)
    {
        //
    }

    /**
     * Determine whether the user can create resumes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the resume.
     *
     * @param  \App\User  $user
     * @param  \App\Resume  $resume
     * @return mixed
     */
    public function update(User $user, Resume $resume)
    {
        return $user->id === $resume->user_id;
    }

    /**
     * Determine whether the user can delete the resume.
     *
     * @param  \App\User  $user
     * @param  \App\Resume  $resume
     * @return mixed
     */
    public function delete(User $user, Resume $resume)
    {
        //
    }
}
