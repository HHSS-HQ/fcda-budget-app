<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\RoleController;
use DB;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('content.authentications.auth-register-basic');
    }

    public function add_user()
    {
        return view('content.pages.users.add-user');
    }


    public function allUsers()
    {
        // $user = User::all('id', 'name', 'email', 'username', 'role_id');
        // $user = DB::select('SELECT users.*, role.role_name FROM users')
        // ->join->on ('role', 'role.id', '=', 'users.role_id');

        $users = DB::table('users')
        ->select('users.*', 'role.role_name')
            ->leftjoin('role', 'role.id', '=', 'users.role_id')
            ->get();
// return $users;
        return view('content.pages.users.users', compact('users') );

    }
    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        
        $user = User::create($request->validated());

        auth()->login($user);

        return redirect('/login')->with('success', "Account successfully registered. Pleaae contact admin to activate your account");
    }


    // public function updateUser(Request $request, $id)
    // {
    //   $this->validate($request, [
    //     // 'farm_location' => 'required|string',
    //     'name' => 'required|string',
    //     'email' => 'required|string',
    //     'role_id' => 'required|string',
    //   ]);;
  
  
    //   if (User::where(['id' => $id])->exists()) {
    //     $user = User::find($id);
    //     $user->name =  $request->name;
    //     $user->email = $request->email;
    //     $user->role_id =   $request->role_id;
    //     $user->save();
  
    //     return redirect('/users')->with('success', "User details successfuly updated.");
    // }
    // }


    public function updateUser(Request $request, $id)
    {
      if (User::where('id', $id)->exists()) {
        $user = User::find($id);
        $user->name = is_null($request->name) ? $user->name : $request->name;
        $user->email = is_null($request->email) ? $user->email : $request->email;
        $user->role_id = is_null($request->role_id) ? $user->role_id : $request->role_id;
        $user->save();
        return redirect('/users')->with('success', "User details successfuly updated.");
    }
}

}