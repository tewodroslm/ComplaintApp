<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    
    public function getDisableAccount(Request $request){

        $feedback = DB::table('complaints')
                        ->where('id', $request->id)->first();
        
        $user = User::where('id', $feedback->user_id)->first();

        return view('userstatus', compact('user'));
    }

    // Moderator disable member account
    public function disableAccount(Request $request){ 
    
        $user = User::where('id',$request->id)->first();
        $user->active = "No";
        $user->save();
        dd($user);

        return redirect('home');
    }

    // Create admin
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        
        //$user->assignRole("Admin");
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

}
