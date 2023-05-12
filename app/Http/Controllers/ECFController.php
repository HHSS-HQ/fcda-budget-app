<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use DB;
use App\Models\Subhead;
use App\Models\ECF;
use App\Models\User;

use Barryvdh\DomPDF\Facade as PDF;


class ECFController extends Controller
{

  public function __construct()
  {
      // user must log in to use this controller
      $this->middleware('auth');
  }

    public function show()
    {
        return view('content.pages.ecf.add-ecf');
    }



    public function store(Request $request)
  {
    $this->validate($request, [
      'department_id' => 'required|string',
      'subhead_id' => 'required|string',
    //   'created_by' => 'required',

    ]);


    // \Log::info($request->all());
    $ecf = new ECF();
    $active_budget = DB::table('budget')
    ->select('budget.id')
    ->where('status', '=', 'ACTIVE')
    ->first();
    if ($active_budget) {
      $active_budget_id = $active_budget->id;
    }

    $ecf->department_id = $request->department_id;
    $ecf->subhead_id = $request->subhead_id;
    $ecf->expenditure_item = $request->expenditure_item;
    $ecf->payee_id = $request->payee_id;
    $ecf->approved_provision = $request->approved_provision;
    $ecf->revised_provision = $request->revised_provision;
    $ecf->present_requisition = $request->present_requisition;
    $ecf->budget_id = $active_budget_id;
    $ecf->prepared_by = auth()->id();

    $ecf->save();

    return redirect('/ecfs')->with('success', "ECF generated successfully.");
  }



  public function index()
  {
      $data['departments'] = Department::get(["department_name", "id"]);
      return view('content.pages.ecf.add-ecf', $data);
  }


  public function fetchSubhead(Request $request)
  {
      $data['subheads'] = Subhead::where("department_id", "$request->department_id")
                              ->get(["subhead_name", "id"]);

      return response()->json($data);
  }


  public function fetchApprovedProvision(Request $request)
  {
      $data['approved_provisions'] = Subhead::where("id", $request->subhead_id)
                                  ->get(["approved_provision", "id"]);

      return response()->json($data);
  }

  public function fetchRevisedProvision(Request $request)
  {
      $data['revised_provisions'] = Subhead::where("id", $request->subhead_id)
                                  ->get(["revised_provision", "id"]);

      return response()->json($data);
  }


    public function AllECF( Request $request )
    {
      // $ecfs = ECF::get();
      $ecfs = ECF::query()
      ->with(['department' => function ($query) {$query->select('id', 'department_name as dept_name');}])
      ->with(['subhead' => function ($query) {$query->select('id', 'subhead_name');}])
      ->with(['payee' => function ($query) {$query->select('id', 'name as payee_name');}])
      ->get();
        // $ecfs = DB::select('select * from ecf')->get();
        return view('content.pages.ecf.ecfs', compact('ecfs') );
        // return $ecfs;
    }



    public function updateDepartment(Request $request, $id)
    {
      if (Department::where('id', $id)->exists()) {
        $department = Department::find($id);
        $department->department_name = is_null($request->department_name) ? $department->department_name : $request->department_name;
        $department->remarks = is_null($request->remarks) ? $department->remarks : $request->remarks;
        // $department->department_id = is_null($request->department) ? $unit->department_id : $request->department_id;
        $department->save();
        return redirect('/departments')->with('success', "ECF has successfuly been updated.");
    }
}


public function printECF(Request $request)
{

  $ecfs = ECF::query()
  ->with(['department' => function ($query) {$query->select('id', 'department_name as dept_name');}])
  ->with(['ecf_prepared_by' => function ($query) {$query->select('id', 'name as ecf_prepared_by');}])
  ->with(['ecf_checked_by' => function ($query) {$query->select('id', 'name as ecf_checked_by');}])
  ->with(['subhead' => function ($query) {$query->select('id', 'subhead_name');}])
  ->with(['payee' => function ($query) {$query->select('id', 'payee_name');}])
  ->where('id', '=', $request->id)
  ->get();
    $pdf = \PDF::loadView('content.pages.pdf.ecf', compact('ecfs'));
    // // Stream the PDF to the HTTP response
    return $pdf->stream();
}


// UPDATE ECF

public function changeECFStatus(Request $request){
  $update = ECF::where('id', '=', $request->input('id'))
  ->update(['status' => 'APPROVED', 'checked_by' => auth()->id()]);
  return redirect()->back()->with('message', 'ECF updated successfully.');

}

}
