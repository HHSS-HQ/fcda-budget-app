<?php

namespace App\Http\Controllers;
use App\Models\Subhead;
use Illuminate\Http\Request;
use DB;

class SubheadController extends Controller
{
    public function show()
    {
        return view('content.pages.subhead.add-subhead');
    }

    // public function store(UnitRequest $request) 
    // {
        
    //     $user = Unit::create($request->validated());
    //     return redirect('/unit')->with('success', "Unit created successfully.");
    // }

    public function store(Request $request)
    {
      $this->validate($request, [
        'subhead_code' => 'required',
        'subhead_name' => 'required|string',
        'remarks' => 'required|string',
        
      ]);
  
      $subhead = new Subhead();
  
      $subhead->subhead_code = $request->subhead_code;
      $subhead->subhead_name = $request->subhead_name;
      $subhead->remarks = $request->remarks;
      // $subhead->status = $request->status;
      $subhead->created_by = auth()->id();
      $subhead->save();
      
  
  
      return redirect('/subheads')->with('success', "Subhead added successfully.");
    }
  
    //   public function AllUnits( Request $request )
    //   {
    //       $units = DB::table('unit')->get();
    //       return view('content.pages.unit.units', compact('units') );
    //   }

      public function AllSubheads()
      {
  
          $subheads = DB::table('subhead')
          ->select('subhead.*')
            //   ->leftjoin('department', 'department.id', '=', 'unit.department_id')
              ->get();
          return view('content.pages.subhead.subheads', compact('subheads') );
  
      }

      public function updateSubhead(Request $request, $id)
      {
        if (Subhead::where('id', $id)->exists()) {
          $subhead = Subhead::find($id);
          $subhead->subhead_code = is_null($request->subhead_code) ? $subhead->subhead_code : $request->subhead_code;
          $subhead->subhead_name = is_null($request->subhead_name) ? $subhead->subhead_name : $request->subhead_name;
          $subhead->remarks = is_null($request->remarks) ? $subhead->remarks : $request->remarks;
          $subhead->status = is_null($request->status) ? $subhead->status : $request->status;
          $subhead->save();
          return redirect('/subheads')->with('success', "Subhead has successfuly been updated.");
      }
  }
}
