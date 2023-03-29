<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function __construct()
  {
      // user must log in to use this controller
      $this->middleware('auth');
  }
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $project = DB::table('project')->get();
                    //   \Log::info($project);

        return view('/dashboard', ['project' => $project]);

    }
}
