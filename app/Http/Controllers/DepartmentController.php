<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use DB;
use App\Models\ECF;
class DepartmentController extends Controller
{

  public function __construct()
  {
      // user must log in to use this controller
      $this->middleware('auth');
  }

    public function show()
    {
        return view('content.pages.department.add-department');
    }


    // public function budget_utilization()
    // {
    //     return view('content.pages.department.budget-utilization');
    // }


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

    public function budget_utilization2(Request $request)
    {
      // return "ok";
        // $budget_utilization = DB::table('ecf')->where('department_id', '=', $request->id)->get();
        // return $budget_utilization;

        $budget_utilization = ECF::query()
        ->with(['department' => function ($query) {$query->select('id', 'department_name as dept_name');}])
        ->with(['subhead' => function ($query) {$query->select('id', 'subhead_name');}])
        ->with(['payee' => function ($query) {$query->select('id', 'name as payee_name');}])
        ->get();

        return view('content.pages.department.budget-utilization', compact('budget_utilization') );
          // return view('content.pages.ecf.ecfs', compact('ecfs') );
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
