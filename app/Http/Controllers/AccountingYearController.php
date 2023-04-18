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

    public function storeAccountingYear(){

    }
}
