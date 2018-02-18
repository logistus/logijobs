<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ConfirmEmail;
use App\Resume;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->verify_token = str_random(30);
        });
    }

    public function confirmEmail()
    {
        $this->verified = true;
        $this->verify_token = null;
        $this->save();
    }

    public function updateAcoountSettings($data) {
        $this->first_name = $data["first_name"];
        $this->last_name = $data["last_name"];
        $this->email = $data["email"];
        $this->save();
    }

    public function updatePersonalInfo($data) {
        $this->nationalities = $data["nationality"];
        $this->born_country_id = $data["born_country_id"];
        $this->gender = $data["gender"];
        $this->marital_status = $data["marital_status"];
        $this->licence = $data["licence"];
        $this->birth_date = $data["birth_date"];
        $this->military_status = $data["military_status"];
        $this->military_postpone_date = $data["postpone_date"];
        $this->military_discharge_date = $data["discharge_date"];
        $this->military_exempt_reason = $data["exempt_reason"];
        $this->save();
    }

    public function changePassword($new_password) {
        $this->password = bcrypt($new_password);
        $this->save();
    }

    public function resumes() {
        return $this->hasMany('App\Resume');
    }
}
