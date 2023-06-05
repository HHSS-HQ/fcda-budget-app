<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use DB;
use App\Models\ECF;
use App\Models\DepartmentBudget;

use PHPExcel;
use PHPExcel_IOFactory;
use Dompdf\Dompdf;
use Illuminate\Http\Response;


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
      // 'created_by' => 'required',

    ]);


    // \Log::info($request->all());
    $departments = new Department();

    $departments->department_name = $request->department_name;
    $departments->department_code = $request->department_code;
    $departments->remarks = $request->remarks;
    $departments->department_code = $request->department_code;
    $departments->created_by = auth()->id();

    $departments->save();

    return redirect('/departments')->with('success', "Department created successfully.");
  }

  public function budget_store(Request $request)
  {
    $department_budget = new DepartmentBudget();

    $department_budget->parent_budget_id = $request->parent_budget_id;
    $department_budget->department_id = $request->department_id;
    $department_budget->budgetary_allocation = $request->budgetary_allocation;
    $department_budget->budget_utilization = $request->budget_utilization;
    $department_budget->remarks = $request->remarks;
    $department_budget->created_by = auth()->id();

    $department_budget->save();

    return redirect('/departments')->with('success', "Department budget created successfully.");
  }


  public function budget_update(Request $request, $id)
  {
    // $id = $request->id;
    if (DepartmentBudget::where('id', $id)->exists()) {
      $department_budget = DepartmentBudget::find($id);
      $department_budget->budgetary_allocation = $request->budgetary_allocation;

      $department_budget->save();
      return redirect('/departments')->with('success', "Budget has successfuly been updated.");
  }
}



    public function AllDepartments( Request $request )
    {
      $departments = DB::table('department')
        ->select('department.*', 'budget.id as budget_id')
        ->leftJoin('department_budget', 'department_budget.parent_budget_id', '=', 'department_budget.department_id')
        ->leftJoin('budget', 'department_budget.parent_budget_id', '=', 'budget.id')
        ->get();

        return view('content.pages.department.departments', compact('departments') );

    }

    public function budget_utilization2(Request $request)
    {
      // return "ok";
        // $budget_utilization = DB::table('ecf')->where('department_id', '=', $request->id)->get();
        // return $budget_utilization;

        $budget_utilization = ECF::query()
        ->with(['department' => function ($query) {$query->select('id', 'department_code', 'department_name as dept_name');}])
        ->with(['subhead' => function ($query) {$query->select('id', 'subhead_name');}])
        ->with(['payee' => function ($query) {$query->select('id', 'payee_name as payee_name');}])
        ->where('department_id', '=', $request->id)
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



public function exportExcel()
{
    $departments = Department::all();
    $excel = new PHPExcel();
    $excel->getActiveSheet()
          ->setCellValue('A1', 'SN')
          ->setCellValue('B1', 'Department Name')
          ->setCellValue('C1', 'Department Code');

    $row = 2;
    $sn = 1;
    foreach ($departments as $department) {
        $excel->getActiveSheet()
              ->setCellValue('A' . $row, $sn++)
              ->setCellValue('B' . $row, $department->department_name)
              ->setCellValue('C' . $row, $department->department_code);
        $row++;
    }

    $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $writer->save('departments.xlsx');

    return response()->download('departments.xlsx')->deleteFileAfterSend(true);
}

public function exportPDF()
{
    // $departments = Department::all();
    $departments = DB::table('department')
        ->select('department.*', 'budget.id as budget_id')
        ->leftJoin('department_budget', 'department_budget.parent_budget_id', '=', 'department_budget.department_id')
        ->leftJoin('budget', 'department_budget.parent_budget_id', '=', 'budget.id')
        ->get();

    $html = view('content.pages.department.departments2', compact('departments'));

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('departments.pdf');

    return new Response($dompdf->output(), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="departments.pdf"',
    ]);
}


}
