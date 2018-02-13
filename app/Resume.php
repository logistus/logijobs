<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{    
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function contact_info() {
        return $this->hasOne('App\ResumeContact', 'resume_id');
    }

    public function toggleStatus() {
        $this->status = !$this->status;
        $this->save();
    }

    public function justUpdate() {
        $this->updated_at = now();
        $this->save();
    }

    public function updatePrivacy($privacy_id) {
        $this->privacy = $privacy_id;
        $this->save();
    }
}
