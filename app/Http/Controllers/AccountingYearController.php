<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountingYear;

class AccountingYearController extends Controller
{
    public function displayYear()
    {
      $accounting_year = AccountingYear::all();
      // return $accounting_year;
      return view('content.pages.settings.accounting-year', compact('accounting_year'));
    }

    public function addAccountingYearForm(){
      return view('content.pages.settings.add-accounting-year');
    }

    public function storeAccountingYear(Request $request){
$add_accounting_year = new AccountingYear();
$add_accounting_year->accounting_year_name = $request->accounting_year_name;
$add_accounting_year->start_date = $request->start_date;
$add_accounting_year->end_date = $request->end_date;
$add_accounting_year->comment = $request->comment;

$add_accounting_year->save();

// return $add_accounting_year;
// return view('content.pages.settings.accounting-year');
return redirect()->back()->with('success', 'Accounting Year added successfully.');
    }
}
