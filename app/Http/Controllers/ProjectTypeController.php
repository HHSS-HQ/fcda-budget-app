<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectTypeRequest;
use App\Models\ProjectType;
use DB;

class ProjectTypeController extends Controller
{
    public function show()
    {
        return view('content.pages.project-type.add-project-type');
    }


    public function store(Request $request)
    {
      $this->validate($request, [
        'project_type' => 'required|string',
        'remarks' => 'required|string',
  
      ]);
  
      
      // \Log::info($request->all());
      $project_type = new ProjectType();
  
      $project_type->project_type = $request->project_type;
      $project_type->remarks = $request->remarks;
      $project_type->created_by = auth()->id();
  
      $project_type->save();
  
      return redirect('/project-types')->with('success', "Project Type created successfully.");
    }
  


      public function AllProjectTypes()
      {
  
          $project_types = DB::table('project_type')
          ->select('project_type.*')
              
              ->get();
  // return $users;
          return view('content.pages.project-type.project-types', compact('project_types') );
  
      }

      public function updateProjectType(Request $request, $id)
      {
        if (ProjectType::where('id', $id)->exists()) {
          $project_type = ProjectType::find($id);
          $project_type->project_type = is_null($request->project_type) ? $project_type->project_type : $request->project_type;
          $project_type->remarks = is_null($request->remarks) ? $project_type->remarks : $request->remarks;
          
          $project_type->save();
          return redirect('/project-types')->with('success', "Project Type has successfuly been updated.");
      }
  }
}
