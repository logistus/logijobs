<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PasswordChanged;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function updateEmail(Request $request)
    {
        $user = User::where("id", Auth::id());
        if (User::where('email', $request->input('email'))->where('id', '!=', Auth::id())->count() == 0) {
            $user->firstOrFail()->updateAcoountSettings($request->all());
        } else {
            echo 0;
        }
    }

    public function updatePersonalInfo(Request $request)
    {
        $user = User::where("id", Auth::id())->firstOrFail();
        $user->updatePersonalInfo($request->all());
    }

    public function changePassword(Request $request)
    {
        $user = User::where("id", Auth::id())->firstOrFail();
        if (Hash::check($request->input("current_password"), Auth::user()->password)) {
            $user->changePassword($request->input("new_password"));
        } else {
            echo 0; // invalid current password
        }
    }

    public function destroy($id)
    {
        //
    }
}
