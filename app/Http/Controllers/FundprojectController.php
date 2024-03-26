<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fundproject;
use App\Models\Project;
use Carbon\Carbon;
use App\Models\Budget;
use App\Models\Transactions;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class FundprojectController extends Controller
{
    //
    public function showProjectFundings(){
      Fundproject::query();
    }

    public function fundProject(Request $request) {
      DB::beginTransaction();
  
      try {
          $active_budget = DB::table('budget')
              ->select('budget.id')
              ->where('status', '=', 'ACTIVE')
              ->first();
          
          if ($active_budget) {
              $activeBudgetId = $active_budget->id;
          }
  
          Log::info('Active budget retrieved: ' . $activeBudgetId);
  
          $payee = DB::table('project')
              ->select('project.department_id', 'payee_new.payee_id', 'payee_new.payee_bank', 'payee_new.payee_account_number')
              ->join('payee_new', 'payee_new.payee_id', '=', 'project.payee_id')
              ->where('project_id', '=', $request->project_id)
              ->first();

          // $payee = DB::table('project')
          // ->select('payee_id')
          // ->where('id', '=', $request->project_id)
          // ->first();
      
      if ($payee) {
        $payeeID = $payee->payee_id; 
        $payeeBank = $payee->payee_bank;
          $payeeAccountNumber = $payee->payee_account_number;
      }
      
      $department_id = User::select('department_id')->where('id', '=', auth()->id())->first();
      $department_id2 = $department_id->department_id;
          // Log::info('Payee information retrieved' . $payeeID);
  
          // Create and save fund project
          $fundProject = new Fundproject();
          $fundProject->project_id = $request->project_id;
          $fundProject->amount = $request->amount;
          $fundProject->comment = $request->comment;
          $fundProject->budget_id = $activeBudgetId;
          $fundProject->added_by = auth()->id();
          $fundProject->save();
  
          Log::info('Fund project saved');
  
          // Create and save transaction
          $transaction = new Transactions();
          $transaction->project_id = $request->project_id;
          $transaction->transaction_type = "Project";
          $transaction->transaction_amount = $request->amount ?? $transaction->amount;
          $transaction->payee_id = $payeeID;
          $transaction->payee_bank = $payeeBank;
          $transaction->payee_account_number = $payeeAccountNumber;
          $transaction->narration = $request->comment;
          $transaction->budget_id = $activeBudgetId;
          $transaction->department_id = $department_id2;
          $transaction->updated_by = Auth::user()->id;
          $transaction->transaction_date = Carbon::now();
          $transaction->save();
  
          Log::info('Transaction saved');
  
          // Update project
          Project::where('id', '=', $request->project_id)
              ->update(['last_funded_date' => Carbon::now()]);
  
          Log::info('Project updated');
  
          DB::commit();
  
          return back()->with('success', 'Success! Project successfully funded');
      } catch (\Exception $e) {
          DB::rollback();
  
          Log::error('Failed! Error funding project: ' . $e->getMessage());
  
          return back()->with('error', 'Failed! Error funding project: ' . $e->getMessage());
      }
  }



}
