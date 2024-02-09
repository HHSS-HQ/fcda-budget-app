<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Subhead;
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
            ->select('subhead.*', 'department.department_name')
            ->leftjoin('department', 'department.id', '=', 'subhead.department_id')
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
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal-2" data-role-id="' . $row->role_id . '"> Edit </a> <a   class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}