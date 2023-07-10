<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index() {
        $id = Auth::user()->id;

        $user = User::select('id', 'name', 'email', 'address', 'phone', 'gender')->where('id', $id)->first();

        return view('admin.profile.index', compact('user'));
    }

    //update admin account
    public function updateAdmin(Request $request) {
        $id = Auth::user()->id;
        $this->validationCheck($request);
        $userData = $this->getUserData($request);
        User::where('id', $id)->update($userData);
        return back()->with(['updateSuccess' => 'Updated Successfully']);

    }

    //direct to change password page
    public function password() {
        return view('admin.profile.changePassword');
    }

    //change password
    public function changePassword(Request $request) {
        $this->passwordValidationCheck($request);
        $id = Auth::user()->id;
        $user = User::select('password')->where('id', $id)->first();
        $dbPassword = $user->password;
        if(Hash::check($request->oldPassword, $dbPassword)){
            User::where('id', $id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            return back()->with(['passwordChanged' => "Password has been changed Successfully!"]);
        }
        return back()->with(['noMatch' => 'The old password did not match the new one']);
    }

    //admin account validation check
    private function validationCheck($request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ])->validate();
    }

    //get user data
    private function getUserData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'updated_at' => Carbon::now(),
        ];
    }

    //password validation check
    private function passwordValidationCheck($request) {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:5|max:10',
            'newPassword' => 'required|min:5|max:10',
            'confirmedPassword' => 'required|min:5|max:10|same:newPassword',
        ])->validate();
    }
}
