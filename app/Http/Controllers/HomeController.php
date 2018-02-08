<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\City;
use App\Resume;
use Auth;
use Jenssegers\Date\Date;

class HomeController extends Controller
{
  public function __construct() {
      $this->middleware("auth")->except(["index", "updated"]);
      Date::setLocale(app()->getLocale());
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

  public function resumes() {
    $cities = City::all();
    $user_resumes = Auth::user()->resumes;
    return view('resumes', compact('cities', 'user_resumes'));
  }
}
