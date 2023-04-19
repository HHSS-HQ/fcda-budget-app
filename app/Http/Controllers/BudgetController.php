<?php

namespace App\Http\Controllers;
use App\Models\Budget;
use Illuminate\Http\Request;
use DB;
class BudgetController extends Controller
{
    public function show()
    {
        return view('content.pages.budget.add-budget');
    }

    // public function store(UnitRequest $request)
    // {

    //     $user = Unit::create($request->validated());
    //     return redirect('/unit')->with('success', "Unit created successfully.");
    // }

    public function store(Request $request)
    {


      $budgets = new Budget();

      $budgets->budget_year = $request->budget_year;
      $budgets->code = $request->code;
      $budgets->remarks = $request->remarks;
      $budgets->appropriated_amount = $request->appropriated_amount;
      $budgets->created_by = auth()->id();

      $budgets->save();

      return redirect('/budgets')->with('success', "Budget added successfully.");
    }

    //   public function AllUnits( Request $request )
    //   {
    //       $units = DB::table('unit')->get();
    //       return view('content.pages.unit.units', compact('units') );
    //   }

      public function AllBudgets()
      {

        $budgets = DB::table('budget')
        ->select('budget.*', 'budget.id as budget_id', 'budget.status as budget_status', 'accounting_year.*', DB::raw('SUM(project_funding.amount) as total_funding'))
        ->leftJoin('accounting_year', 'accounting_year.id', '=', 'budget.budget_year')
        ->leftJoin('project_funding', 'project_funding.budget_id', '=', 'budget.id')
        ->groupBy('budget.id')
        ->get();

          return view('content.pages.budget.budgets', compact('budgets') );

      }

      public function updateBudget(Request $request, $id)
      {
        if (Budget::where('id', $id)->exists()) {
          $budget = Budget::find($id);
          $budget->budget_year = is_null($request->budget_year) ? $budget->budget_year : $request->budget_year;
          $budget->code = is_null($request->code) ? $budget->code : $request->code;
          $budget->status = is_null($request->status) ? $budget->status : $request->status;
          $budget->appropriated_amount = is_null($request->appropriated_amount) ? $budget->appropriated_amount : $request->appropriated_amount;
          $budget->save();
          return redirect('/budgets')->with('success', "Budget has successfuly been updated.");
      }
  }

  public function setActiveBudget(Request $request){
    Budget::where('status', '=', 'ACTIVE')->update(['status' => 'INACTIVE']);
    $active_budget = Budget::findOrFail($request->id);
    $active_budget->status = 'ACTIVE';
    $active_budget->save();
    // return "success";
    return redirect()->back()->with('success', 'Budget status updated successfully.');
}

}
