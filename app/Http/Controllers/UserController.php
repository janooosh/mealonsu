<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\user;
use App\role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {


        if(!UserController::isRole(auth()->user(),1)) {
            return redirect()->route('posts.index');
        }
        $users = User::all();
        return view('users.index', compact('users'))->with('error','Action not allowed');
    }

    public function profile(User $user) {
        if(!auth()->user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        $roles = Role::all();
        $user->isUserAdmin = UserController::isRole($user,1);
        $user->created = Carbon::parse($user->created_at)->format('D, d.m.y');
        return view('users.profile',compact('user','roles'));
    }

    public function update(Request $request, User $user) {
        //Validate Input
        if(!auth()->user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role*' => 'exists:roles,id'
        ]);
        //Update User
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->save();

        //Admin
        if($this->admin(1)) {
            $user->roles()->sync($request->get('role'));
            return redirect()->route('users.index')->with('success','Profile Updated');
        }

        //No admin
        return redirect()->route('users.profile',$user)->with('success','Profile Updated');
    }

    public function admin($role_id) {
        $role = Role::find($role_id);
        return auth()->user()->roles->contains($role);
    }
    public static function isAdmin() {
        if(auth()->user()->roles->contains(1)) {
            return true;
        }
        return false;
    }

    public static function hasRole($role_id) {
        $role = Role::find($role_id);
        return auth()->user()->roles->contains($role);
    }

    public static function isRole(User $user,$role_id) {
        $role = Role::find($role_id);
        return auth()->user()->roles->contains($role);
    }

}
