<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\User;
use App\City;
use App\Resume;
use Auth;

class HomeController extends Controller
{
  public function __construct() {
      $this->middleware("auth")->except(["index"]);
  }

  public function index()
  {
    $cities = City::all();
    return view('home', compact('cities'));
  }

  public function settings() {
    $cities = City::all();
    return view('settings', compact('cities'));
  }

    public function infos() {
        $cities = City::all();
        $countries = Country::all();
        return view('infos', compact('cities', 'countries'));
    }
}
