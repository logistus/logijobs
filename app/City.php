<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function counties() {
        return $this->hasMany('App\County');
    }
}
