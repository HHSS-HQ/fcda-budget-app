<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Contractor;

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

    public function getContractors(){
      $contractor = Contractor::all();
      return view('content.pages.projects.add-project', compact('contractor'));
      // return Response::json($contractor);
      // $latestContractor = Contractor::latest()->first();
      // return $latestContractor;


    }
}
