<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('content.pages.settings.add-role');
    }

    /**
     * Handle account registration request
     *
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {

        $user = Role::create($request->validated());
        //  return redirect('/role')->with('success', "Role successfully added.");
         return redirect()->back()->with('success', 'Role successfully added.');
    }

    public function AllRoles( Request $request )
    {
        $roles = DB::table('role')->get();
        return view('content.pages.settings.roles', compact('roles') );
    }

    public function AllRoles2( Request $request )
    {
        // $items = Role::get();
        $roles =  Role::select('role_name', 'id')->get();
        return view('content.pages.users.users', compact('roles') );
    }

    // public function id()
    // {
    //     return $this->belongsTo(Role::class);
    // }
}
