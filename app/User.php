<?php

namespace App;

use App\Notifications\EmailChanged;
use App\Notifications\PasswordChanged;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password'
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
        $this->email = $data["email"];
        if ($this->isDirty('email')) {
            $this->verified = false;
            $this->verify_token = str_random(30);
            $this->notify(new EmailChanged($this->verify_token, $this->first_name));
            echo 1;
        } else {
            echo 2;
        }
        $this->save();
    }

    public function updatePersonalInfo($data) {
        $this->first_name = $data["first_name"];
        $this->last_name = $data["last_name"];
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
        if ($this->isDirty()) {
            echo 1;
        } else {
            echo 0;
        }
        $this->save();
    }

    public function changePassword($new_password) {
        $this->password = bcrypt($new_password);
        $this->save();
        $this->notify(new PasswordChanged($this->first_name));
        Auth::loginUsingId($this->id);
        echo 1;
    }

    public function resumes() {
        return $this->hasMany('App\Resume');
    }
}
