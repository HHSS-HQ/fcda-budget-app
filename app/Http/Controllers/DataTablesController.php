<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Subhead;
use App\Models\SubheadAllocation;
use App\Models\Department;
use DataTables;
use App\DataTables\ExportDataTable;
use DB;
use App\Models\Users;
use App\Models\Transactions;

class DataTablesController extends Controller
{
    public function index()
    {
        return view('content.pages.subhead.subheads');
    }

    public function index_users()
    {
        return view('content.pages.users.users');
    }

    public function getSubheads(Request $request)
    {
        if ($request->ajax()) {
            // $data = Subhead::latest()->get()
            $data = DB::table('subhead')
            ->select('subhead.*')
            // ->leftjoin('department', 'department.id', '=', 'subhead.department_id')
            ->get();
            // return $data;
            return Datatables::of($data)
            // return $dataTable->render('export');
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function getAllSubheadAllocations(Request $request)
    {
        // $totalAmount = DB::table('transactions')
        //     ->select(DB::raw('SUM(transaction_amount) as total'))
        //     ->first();
        //     $amount = $totalAmount->total ?? 0;
        // return $amount;
        if ($request->ajax()) {
            // $data = Subhead::latest()->get()
            // $data = SubheadAllocation::with('subhead', 'department')->get();
            $data = DB::table('subhead_allocation')
    ->select(
        'subhead_allocation.*',
        'subhead_allocation.approved_provision',
        'subhead.subhead_code as subhead_code',
        'subhead.subhead_name as subhead_name',
        'department.department_name as department_name',
        DB::raw('(SELECT subhead_allocation.approved_provision)-(SELECT SUM(ecf.present_requisition) FROM ecf WHERE ecf.subhead_id = subhead.id) as totalAmount'),
        // DB::raw('(SELECT SUM(ecf.present_requisition) FROM ecf WHERE ecf.subhead_id = subhead.id) - ecf.present_requisition as remainingRequisition')
    )
    ->leftJoin('subhead', 'subhead.id', '=', 'subhead_allocation.subhead_id')
    ->leftJoin('ecf', 'ecf.subhead_id', '=', 'subhead_allocation.subhead_id')
    ->leftJoin('department', 'department.id', '=', 'subhead_allocation.department_id')
    // ->where('department.id', '=', 1)
    ->get();

        
        
        // return $totalAmount;

        // $amount = $totalAmount->total ?? 0;
            
            return Datatables::of($data)
            // return $dataTable->render('export');
            // ->with('totalAmount', $amount)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal-3"  data-id="' . $row->id. '"  data-department_id="' . $row->department_id. '"  data-approved_provision="' . $row->approved_provision. '"  data-department_name="' . $row->department_name. '"  data-subhead_name="' . $row->subhead_name. '">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function getSubheadAllocations(Request $request)
    {
        if ($request->ajax()) {
            // $data = Subhead::latest()->get()
            // $data = SubheadAllocation::with('subhead', 'department')
            // ->where('department_id', auth()->id())
            // ->get();
            $data = DB::table('subhead_allocation')
            ->select('subhead_allocation.*', 'subhead.subhead_name as subhead_name', 'department.department_name as department_name', 'subhead.subhead_code as subhead_code')
            ->join('subhead', 'subhead.id', '=', 'subhead_allocation.subhead_id')
            ->join('department', 'department.id', '=', 'subhead_allocation.department_id')
            ->get();

            $totalAmount = DB::table('transactions')
    ->select(DB::raw('SUM(amount) as total'))
    ->first();

$amount = $totalAmount->total ?? 0;


            // return $data;
            return Datatables::of($data)
            // return $dataTable->render('export');
            ->with('totalAmount', $amount)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-id="' . $row->id. '">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            // $data = Subhead::latest()->get()
            $data = DB::table('users')
            ->select('users.*', 'department.department_name', 'role.role_name')
            ->leftjoin('department', 'department.id', '=', 'users.department_id')
            ->leftjoin('role', 'role.id', '=', 'users.role_id')
            // ->where('status', '=', 1)
            ->get();
            // return $data;
            return Datatables::of($data)
            // return $dataTable->render('export');
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal-2" data-name="' . $row->name . '" data-username="' . $row->username. '"  data-id="' . $row->id. '"  data-email="' . $row->email. '"> Edit </a> ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function AllTransactions(Request $request)
    {

        if ($request->ajax()) {
            // $data = Subhead::latest()->get()
            $data = DB::table('transactions')
            ->select('transactions.*', 'payee_new.payee_name')
            ->leftjoin('payee_new', 'payee_new.payee_id', '=', 'transactions.payee_id')
            // ->leftjoin('role', 'role.id', '=', 'users.role_id')
            ->get();
            // return $data;
            return Datatables::of($data)
            // return $dataTable->render('export');
                ->addIndexColumn()
                // ->addColumn('action', function($row){
                //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal-2"> Edit </a> <a   class="delete btn btn-danger btn-sm" style="color: white" >Delete</a>';
                //     return $actionBtn;
                // })
                // ->rawColumns(['action'])
                ->make(true);
        }
    }
}