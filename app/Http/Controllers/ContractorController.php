<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Contractor;
use DB;

class ContractorController extends Controller
{
    //

    public function addContractorModal(Request $request){
      $contractor = new Contractor();
      $contractor->company_name = $request->company_name;
      $contractor->contractor_name = $request->contractor_name;
      $contractor->contractor_account_number = $request->contractor_account_number;
      $contractor->contractor_account_name = $request->contractor_account_name;
      $contractor->contractor_bank = $request->contractor_bank;
      $contractor->contractor_phone_number = $request->contractor_phone_number;
      // $contractor->added_by = auth()->id();
      $contractor->save();
      // return view('content.pages.projects.add-project', compact('contractor'));
      // return $contractor;
      // $latestContractor = Contractor::latest()->first();
      // return view('content.pages.projects.add-project', compact('latestContractor'));
    }




  public function showContractorForm()
  {
      return view('content.pages.contractor.add-contractor');
  }

    public function showContractors()
    {

        $contractor = DB::table('contractor')
        ->select('contractor.*')
        ->get();
        return view('content.pages.contractor.contractors', compact('contractor') );

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
