<?php
 
namespace App\Http\Controllers;
 
use DB;
use App\Http\Controllers\Controller;
 
class DashboardController extends Controller
{
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
        // return view('/dashboard-statistics', compact('project') );
        // return (['project' => $project]) ;

    }
}