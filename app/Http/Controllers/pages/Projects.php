<?php

namespace App\Http\Controllers\pages;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Projects extends Controller
{
  public function ViewProject()
  {
    return view('content.pages.projects.projects');
  }

  public function AddProject()
  {
    return view('content.pages.projects.add-project');
  }

      // Store Contact Form data
      public function ProjectForm(Request $request, Project $project) {
        // Form validation
        $this->validate($request, [
            'project_title' => 'required',
            'project_location' => 'required',
            // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            // 'subject'=>'required',
            // 'message' => 'required'
         ]);
        //  Store data in database
        
        // \Log::info($request->all());
        // Projects::create($request->all());
        $randomNumber = random_int(100000, 999999);

      $project = new Project();
      $project->project_id = $randomNumber;
        $project->project_title = $request->project_title;
        $project->project_location = $request->project_location;
        $project->contractor_name = $request->contractor_name;
        $project->contract_sum = $request->contract_sum;
        $project->date_of_award = $request->date_of_award;
        $project->appropriation = $request->appropriation;
        $project->commencement_date = $request->commencement_date;
        $project->percentage_completion = $request->percentage_completion;
        $project->outstanding_balance = $request->outstanding_balance;
        $project->commencement_date = $request->commencement_date;
        $project->year_last_funded = $request->year_last_funded;
        $project->observations = $request->observations;
        $project->recommendations = $request->recommendations;
        $project->completion_period = $request->completion_period;
        $project->amount_paid_till_date = $request->amount_paid_till_date;
        $project->certified_cv_not_paid = $request->certified_cv_not_paid;
        $project->last_funded_date = $request->last_funded_date;
        $project->challenges = $request->challenges;
        $project->project_year = $request->project_year;
      $project->save();

        // 
        if ($project) {
          return back()->with('success', 'Success! Project created');
      }
      else {
          return back()->with('error', 'Failed! Project not created');
      }

        // return back()->with('success', 'Data successfuly captured.');
    }

    // public function AllProjects()
    // {
    //   $projects = Projects::all();
    //   return view('content.pages.projects.projects')->with('projects', $projects);
    // }

    public function AllProjects( Request $request )
{
    $comm = DB::table('project')->get();
    return view('content.pages.projects.projects', compact('comm') );
}


// public function show( Request $request )
// {
//     $comm = DB::table('bakerysales')
//         ->where('customer_id', Auth::id() ) // Getting the Authenticated user id
//         ->whereMonth('sales_date', $request->input('mn') )
//         ->whereYear('sales_date', $request->input('yr') )
//         ->get();

//     return view('showCommission', compact('comm') );
// }

public function display($project_id)  
{  
  // $comm = DB::table('project')->where('project_id', '=', $project_id)->first();
  // return view('content.pages.projects.view_project', compact('comm') );
  return view('content.pages.projects.view_project2')->with('project_id',$project_id);  
} 

public function one_project($project_id)  
{  
  // $comm = DB::table('project')->where('id', '=', '1')->get();
  // \Log::info($comm);
  // // return view('content.pages.projects.view_project', ["data"=>$comm]);
  // return view('content.pages.projects.view_project', compact('comm') );
  // // return view('content.pages.projects.view_project')->with('project_id',$project_id);  

  $users = $comm = DB::table('project')->where('project_id', '=', $project_id)->get();
  return view('content.pages.projects.view_project', compact('users') );
                    
                    //  \Log::info($users);
} 

  }