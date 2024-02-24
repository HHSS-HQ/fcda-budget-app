<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payee;
use DB;

class PayeeController extends Controller
{

  public function showPayeeForm()
  {
      return view('content.pages.payee.add-payee');
  }

    public function showPayees()
    {

        $payee = DB::table('payee')
        ->select('payee.*')
        ->get();
        return view('content.pages.payee.payees', compact('payee') );

    }

    public function addPayee(Request $request){
      $payee = new Payee();
      $payee->payee_type = is_null($request->payee_type) ? $payee->payee_type : $request->payee_type;
      $payee->payee_name = is_null($request->payee_name) ? $payee->payee_name : $request->payee_name;
      $payee->payee_email = is_null($request->payee_email) ? $payee->payee_email : $request->payee_email;
      $payee->payee_account_name = is_null($request->payee_account_name) ? $payee->payee_account_name : $request->payee_account_name;
      $payee->payee_account_number = is_null($request->payee_account_number) ? $payee->payee_account_number : $request->payee_account_number;
      $payee->payee_bank = is_null($request->payee_bank) ? $payee->payee_bank : $request->payee_bank;
      $payee->payee_sortcode = is_null($request->payee_sortcode) ? $payee->payee_sortcode : $request->payee_sortcode;
      $payee->payee_phone = is_null($request->payee_phone) ? $payee->payee_phone : $request->payee_phone;
      $payee->payee_phone2 = is_null($request->payee_phone2) ? $payee->payee_phone2 : $request->payee_phone2;
      $payee->remarks = is_null($request->remarks) ? $payee->remarks : $request->remarks;


      $payee->created_by = auth()->id();
      $payee->save();
      return redirect()->back()->with('success', 'Payee added successfully.');

    }
}
