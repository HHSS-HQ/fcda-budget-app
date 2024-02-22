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
        if ($request->ajax()) {
            // $data = Subhead::latest()->get()
            $data = SubheadAllocation::with('subhead', 'department')->get();
          
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


    public function getSubheadAllocations(Request $request)
    {
        if ($request->ajax()) {
            // $data = Subhead::latest()->get()
            $data = SubheadAllocation::with('subhead', 'department')
            ->where('department_id', auth()->id())
            ->get();
            // ->select('subhead_allocation.*', 'subhead.subhead_name')
            // ->join('subhead', 'subhead.subhead_code', '=', 'subhead.subhead_code')
            // ->get();
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


    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            // $data = Subhead::latest()->get()
            $data = DB::table('users')
            ->select('users.*', 'department.department_name', 'role.role_name')
            ->leftjoin('department', 'department.id', '=', 'users.department_id')
            ->leftjoin('role', 'role.id', '=', 'users.role_id')
            ->get();
            // return $data;
            return Datatables::of($data)
            // return $dataTable->render('export');
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal-2" data-name="' . $row->name . '" data-username="' . $row->username. '"  data-id="' . $row->id. '"  data-email="' . $row->email. '"> Edit </a> <a   class="delete btn btn-danger btn-sm" style="color: white" >Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}