<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use DB;
class UnitController extends Controller
{
    public function show()
    {
        return view('content.pages.unit.add-unit');
    }

    // public function store(UnitRequest $request) 
    // {
        
    //     $user = Unit::create($request->validated());
    //     return redirect('/unit')->with('success', "Unit created successfully.");
    // }

    public function store(Request $request)
    {
      $this->validate($request, [
        'unit_name' => 'required|string',
        'department_id' => 'required',
        'remarks' => 'required|string',
  
      ]);
  
      
      // \Log::info($request->all());
      $units = new Unit();
  
      $units->unit_name = $request->unit_name;
      $units->department_id = $request->department_id;
      $units->remarks = $request->remarks;
      $units->created_by = auth()->id();
  
      $units->save();
  
      return redirect('/units')->with('success', "Unit created successfully.");
    }
  
    //   public function AllUnits( Request $request )
    //   {
    //       $units = DB::table('unit')->get();
    //       return view('content.pages.unit.units', compact('units') );
    //   }

      public function AllUnits()
      {
  
          $units = DB::table('unit')
          ->select('unit.*', 'department.department_name')
              ->leftjoin('department', 'department.id', '=', 'unit.department_id')
              ->get();
  // return $users;
          return view('content.pages.unit.units', compact('units') );
  
      }

      public function updateUnit(Request $request, $id)
      {
        if (Unit::where('id', $id)->exists()) {
          $unit = Unit::find($id);
          $unit->unit_name = is_null($request->unit_name) ? $unit->unit_name : $request->unit_name;
          $unit->remarks = is_null($request->remarks) ? $unit->remarks : $request->remarks;
          $unit->department_id = is_null($request->department_id) ? $unit->department_id : $request->department_id;
          $unit->save();
          return redirect('/units')->with('success', "Unit has successfuly been updated.");
      }
  }
}
