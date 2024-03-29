<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fundproject;
use App\Models\Project;
use Carbon\Carbon;
use App\Models\Budget;
use DB;

class FundprojectController extends Controller
{
    //
    public function showProjectFundings(){
      Fundproject::query();
    }

    public function fundProject(Request $request){
      $active_budget = DB::table('budget')
      ->select('budget.id')
      ->where('status', '=', 'ACTIVE')
      ->first();
      if ($active_budget) {
        $active_budget_id = $active_budget->id;
      }

      $fund_project = new Fundproject();
      $fund_project->project_id = $request->project_id;
      $fund_project->amount = $request->amount;
      $fund_project->comment = $request->comment;
      $fund_project->budget_id = $active_budget_id;
      $fund_project->added_by = auth()->id();
      $fund_project->save();


      $update_project = Project::where('id', '=', $request->project_id)
      ->update(['last_funded_date' => Carbon::now()]);

      // return $fund_project;

      if ($fund_project) {
        return back()->with('success', 'Success! Project successfuly funded');
    }
    else {
        return back()->with('error', 'Failed! Error funding project');
    }

    }



}
