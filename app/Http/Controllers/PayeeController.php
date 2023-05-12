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
      $payee->payee_name = $request->payee_name;
      $payee->payee_account_number = $request->payee_account_number;
      $payee->payee_account_name = $request->payee_account_name;
      $payee->payee_bank = $request->payee_bank;
      $payee->payee_phone_number = $request->payee_phone_number;
      $payee->alternate_phone_number = $request->alternate_phone_number;

      $payee->added_by = auth()->id();
      $payee->save();
      return redirect()->back()->with('success', 'Payee added successfully.');

    }
}
