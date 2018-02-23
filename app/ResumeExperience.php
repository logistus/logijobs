<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeExperience extends Model
{
    protected $table = 'resume_experiences';
    public $timestamps = false;

    protected $fillable = ['user_id', 'resume_id', 'country_id', 'city_id', 'start_date',
        'still_working', 'end_date', 'company_name', 'job_description', 'job_title'];

    public function resume() {
        return $this->belongsTo('App\Resume');
    }

    public function getCity($city_id) {
        return City::where('id', $city_id)->value('name');
    }

    public function getCountry($country_id) {
        return Country::where('id', $country_id)->value('name');
    }

    public function getWorkType($work_type_id) {
        return WorkType::where('id', $work_type_id)->value('name');
    }
}
