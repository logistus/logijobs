<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    function confirmEmail($verify_token) {
    	User::where("verify_token", $verify_token)->firstOrFail()->confirmEmail();
        generate_flash("success", __("commons.verify_completed"));
        return redirect("login");
    }
}
