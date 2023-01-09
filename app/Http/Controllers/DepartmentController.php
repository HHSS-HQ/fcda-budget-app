<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use DB;

class DepartmentController extends Controller
{

    public function show()
    {
        return view('content.pages.department.add-department');
    }



    public function store(Request $request)
  {
    $this->validate($request, [
      'department_name' => 'required|string',
      'remarks' => 'required|string',
    //   'created_by' => 'required',

    ]);

    
    // \Log::info($request->all());
    $departments = new Department();

    $departments->department_name = $request->department_name;
    $departments->remarks = $request->remarks;
    $departments->created_by = auth()->id();

    $departments->save();

    return redirect('/departments')->with('success', "Department created successfully.");
  }

    public function AllDepartments( Request $request )
    {
        $departments = DB::table('department')->get();
        return view('content.pages.department.departments', compact('departments') );
    }

    public function updateDepartment(Request $request, $id)
    {
      if (Department::where('id', $id)->exists()) {
        $department = Department::find($id);
        $department->department_name = is_null($request->department_name) ? $department->department_name : $request->department_name;
        $department->remarks = is_null($request->remarks) ? $department->remarks : $request->remarks;
        // $department->department_id = is_null($request->department) ? $unit->department_id : $request->department_id;
        $department->save();
        return redirect('/departments')->with('success', "Department has successfuly been updated.");
    }
}

}
