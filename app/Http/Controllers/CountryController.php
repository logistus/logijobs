<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function get_cities($country_id) {
        echo Country::find($country_id)->cities()->orderBy('name')->get()->toJson();
    }
}
