<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use App\Notifications\PasswordChanged;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
        ]);
        User::where("id", Auth::id())->firstOrFail()->updateAcoountSettings($request->all());
        generate_flash("success", __("commons.account_settings_updated"));
        return redirect("settings");
    }

    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|confirmed|min:6',
        ]);
        if (Hash::check($request->input("current_password"), Auth::user()->password)) {
            User::where("id", Auth::id())->firstOrFail()->changePassword($request->input("new_password_confirmation"));
            Auth::user()->notify(new PasswordChanged());
            Auth::loginUsingId(Auth::id());
            generate_flash("success", __("commons.password_changed"));
            return redirect("settings");
        } else {
            generate_flash("error", __("commons.invalid_current_password"));
            return redirect("settings");
        }
    }

    public function destroy($id)
    {
        //
    }
}
