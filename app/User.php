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
        $this->name = $data["name"];
        $this->email = $data["email"];
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
