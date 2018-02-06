<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\City;
use Auth;

class HomeController extends Controller
{
  public function __construct() {
      $this->middleware("auth")->except(["index", "updated"]);
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
}
