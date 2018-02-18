<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeContact extends Model
{
    protected $table = 'resume_contacts';
    public $timestamps = false;

    protected $fillable = ['resume_id', 'city_id', 'county_id', 'home_phone', 'mobile_phone'];

    public function resume() {
        return $this->belongsTo('App\Resume');
    }

    public function updateModel($data)
    {
        $this->city_id = $data['city_id'];
        $this->county_id = $data['county_id'];
        $this->home_phone = $data['home_phone'];
        $this->mobile_phone = $data['mobile_phone'];
        $this->resume->justUpdate();
        $this->save();
    }
}
