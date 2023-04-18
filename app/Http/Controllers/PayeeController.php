<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payee;

class PayeeController extends Controller
{
    //
    public function showPayees(){
      Payee::query();
    }
}
