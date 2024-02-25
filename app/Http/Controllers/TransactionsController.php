<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use DB;

class TransactionsController extends Controller
{

  public function index()
  {
      return view('content.pages.transactions.transactions');
  }


  // public function AllTransactions()
  // {
  //     $transactions = DB::table('transactions')
  //         ->select('transactions.*')
  //         // ->leftjoin('department', 'department.id', '=', 'subhead.department_id')
  //         // ->leftjoin('users', 'users.id', '=', 'subhead.created_by')
  //         // ->leftjoin('head', 'head.id', '=', 'subhead.head_id')
  //         ->paginate(20); // You can change the number '10' to the desired number of items per page.

  //     return view('content.pages.transactions.transactions', compact('transactions'));
  // }


  // public function AllTransactions(Request $request)
  // {
  //   // return "Hi";
  //     if ($request->ajax()) {
  //         // $data = Subhead::latest()->get()
  //         $data = DB::table('transactions')
  //         ->select('transactions.*')
  //         // ->leftjoin('department', 'department.id', '=', 'users.department_id')
  //         // ->leftjoin('role', 'role.id', '=', 'users.role_id')
  //         ->get();
  //         // return $data;
  //         return Datatables::of($data)
  //         // return $dataTable->render('export');
  //             ->addIndexColumn()
  //             ->addColumn('action', function($row){
  //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal-2"> Edit </a> <a   class="delete btn btn-danger btn-sm" style="color: white" >Delete</a>';
  //                 return $actionBtn;
  //             })
  //             ->rawColumns(['action'])
  //             ->make(true);
  //     }
  // }
}
