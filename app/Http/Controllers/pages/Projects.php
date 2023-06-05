<?php

namespace App\Http\Controllers\pages;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade as PDF;


class Projects extends Controller
{
  public function ViewProject()
  {
    return view('content.pages.projects.projects');
  }

  public function fundProjectForm(){
    return view('content.pages.projects.fund-project');
  }

  public function reportProjectForm(){
    return view('content.pages.projects.project-report');
  }

  // public function EditProject()
  // {
  //   return view('content.pages.projects.edit-project');
  // }

  public function EditProject($project_id)
{
  $comm = DB::table('project')->where('project_id', '=', $project_id)->get();
  return view('content.pages.projects.edit-project', compact('comm') );
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
      $project->project_type_id = $request->project_type_id;
        $project->project_title = $request->project_title;
        $project->project_location = $request->project_location;
        $project->contractor_id = $request->contractor_id;
        $project->contract_sum = $request->contract_sum;
        $project->date_of_award = $request->date_of_award;
        $project->appropriation = $request->appropriation;
        $project->commencement_date = $request->commencement_date;
        $project->percentage_completion = $request->percentage_completion;
        $project->outstanding_balance = $request->outstanding_balance;
        $project->commencement_date = $request->commencement_date;
        $project->year_last_funded = $request->year_last_funded;
        // $project->observations = $request->observations;
        // $project->recommendations = $request->recommendations;
        // $project->completion_period = $request->completion_period;
        $project->amount_paid_till_date = $request->amount_paid_till_date;
        $project->certified_cv_not_paid = $request->certified_cv_not_paid;
        $project->last_funded_date = $request->last_funded_date;
        // $project->challenges = $request->challenges;
        $project->project_year = $request->project_year;
        $project->added_by = auth()->id();
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
    $comm = DB::table('project')
    ->select('project.*', 'contractor.*')
    ->leftjoin('contractor', 'contractor.id', '=', 'project.contractor_id')
    ->get();
    return view('content.pages.projects.projects', compact('comm') );
}

public function AllReleases( Request $request )
{
    $comm = DB::table('project_funding')
    ->select('project_funding.*', 'project.*')
    ->leftjoin('project', 'project.id', '=', 'project_funding.project_id')
    ->get();
    return view('content.pages.projects.releases', compact('comm') );
}



public function display($project_id)
{
  return view('content.pages.projects.view_project2')->with('project_id', $project_id);
}

public function one_project($project_id)
{
  $users = $comm = DB::table('project')->where('project_id', '=', $project_id)
  ->select('project.*', 'contractor.*')
  ->leftjoin('contractor', 'contractor.id', '=', 'project.contractor_id')
  ->get();
  return view('content.pages.projects.view_project', compact('users') );
}


public function updateProject(Request $request, $id)
{
  if (Project::where('id', $id)->exists()) {
    $project = Project::find($id);
    $project->project_title = is_null($request->project_title) ? $project->project_title : $request->project_title;
    // $project->subhead_name = is_null($request->subhead_name) ? $subhead->subhead_name : $request->subhead_name;
    // $project->remarks = is_null($request->remarks) ? $subhead->remarks : $request->remarks;
    // $project->status = is_null($request->status) ? $subhead->status : $request->status;
    $project->save();
    return redirect('/projects')->with('success', "Project has successfuly been updated.");
}
}

public function printProjectReport(Request $request)
{

  // $ecfs = Project::query()
  // ->with(['department' => function ($query) {$query->select('id', 'department_name as dept_name');}])
  // ->with(['ecf_prepared_by' => function ($query) {$query->select('id', 'name as ecf_prepared_by');}])
  // ->with(['ecf_checked_by' => function ($query) {$query->select('id', 'name as ecf_checked_by');}])
  // ->with(['subhead' => function ($query) {$query->select('id', 'subhead_name');}])
  // ->with(['payee' => function ($query) {$query->select('id', 'name as payee_name');}])
  // ->where('id', '=', $request->id)
  // ->get();

  $projects = Project::select('project.*', 'project_type.project_type', 'contractor.company_name')
  ->join('project_type', 'project_type.id', '=', 'project.project_type_id')
  ->join('contractor', 'contractor.id', '=', 'project.contractor_id')

  ->where('project_id', '=', $request->project_id)
  ->get();
  // return $projects;

    $pdf = \PDF::loadView('content.pages.pdf.project-report', compact('projects'));
    // // Stream the PDF to the HTTP response
    return $pdf->stream();
}


  }
