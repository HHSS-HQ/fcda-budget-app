<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectReport;

class ProjectReportController extends Controller
{
    public function reportProject(Request $request){
      $project_report = new ProjectReport();
      $project_report->project_id = $request->project_id;
      $project_report->added_by = auth()->id();
      $project_report->save();

    }
}
