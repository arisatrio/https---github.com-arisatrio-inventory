<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use Helper;

class ProfileController extends Controller
{
    public function edit(){
        $roles = Role::all();
        $departments = Department::all();

        $compact = compact(
            'roles',
            'departments',
        );
        return view('profile.edit', $compact);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'department_id' => 'required|exists:departments,id',
        ]);

        $user = User::findOrFail(auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->department_id = $request->department_id;
        $user->username = $request->username;
        $user->save();

        $user->syncRoles($request->roles);


        return response()->json([
            'message' => 'Profile updated successfully',
        ], 200);
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|same:password_confirmation|min:8',
            'password_confirmation' => 'required',
        ]);

        $user = User::findOrFail(auth()->id());
        if(!\Hash::check($request->password, $user->password)){
            return response()->json([
                'errors' => [
                    'password' => 'Password does not match'
                ]
            ], 422);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();


        return response()->json([
            'message' => 'Password updated successfully',
        ], 200);
    }

    public function updatePhoto(Request $request){
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoName = Helper::uploadPhoto($request->photo, 'user');
        $user = User::findOrFail(auth()->id());
        $user->photo = $photoName;
        $user->save();

        return response()->json([
            'message' => 'Photo updated successfully',
        ], 200);
    }
}
