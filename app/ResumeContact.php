<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeContact extends Model
{
    protected $table = 'resume_contacts';
    public $timestamps = false;

    protected $fillable = ['user_id', 'resume_id', 'country_id', 'city_id', 'county_id', 'home_phone', 'mobile_phone'];

    public function resume() {
        return $this->belongsTo('App\Resume');
    }

    public function updateModel($data)
    {
        $this->user_id = $data["user_id"];
        $this->country_id = $data["country_id"];
        $this->city_id = $data['city_id'];
        $this->county_id = $data['county_id'];
        $this->email = $data['email'];
        $this->home_phone = $data['home_phone'];
        $this->mobile_phone = $data['mobile_phone'];
        $this->resume->justUpdate();
        if ($this->isDirty()) {
            echo 1;
        } else {
            echo 2;
        }
        $this->save();
    }
}
