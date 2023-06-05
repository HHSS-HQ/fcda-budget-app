<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
use App\Models\Head;
use DB;
class HeadController extends Controller
{
    public function show()
    {
        return view('content.pages.head.add-head');
    }

    // public function store(UnitRequest $request)
    // {

    //     $user = Unit::create($request->validated());
    //     return redirect('/unit')->with('success', "Unit created successfully.");
    // }

    public function store(Request $request)
    {
      $this->validate($request, [
        'head_name' => 'required|string',


      ]);


      // \Log::info($request->all());
      $heads = new Head();
      $heads->head_code = $request->head_code;
      $heads->head_name = $request->head_name;
      $heads->remarks = $request->remarks;
      $heads->created_by = auth()->id();

      $heads->save();

      return redirect('/heads')->with('success', "Head created successfully.");
    }

    //   public function AllUnits( Request $request )
    //   {
    //       $units = DB::table('unit')->get();
    //       return view('content.pages.unit.units', compact('units') );
    //   }

      public function AllHeads()
      {

          $heads = DB::table('head')
          ->select('head.*')
              ->get();
  // return $users;
          return view('content.pages.head.heads', compact('heads') );

      }

      public function updateHeads(Request $request, $id)
      {
        if (Head::where('id', $id)->exists()) {
          $head = Head::find($id);
          $head->head_code = is_null($request->head_code) ? $head->head_code : $request->head_code;
          $head->head_name = is_null($request->head_name) ? $head->head_name : $request->head_name;
          $head->remarks = is_null($request->remarks) ? $head->remarks : $request->remarks;
          $head->save();
          return redirect('/heads')->with('success', "Head has successfuly been updated.");
      }
  }
}
