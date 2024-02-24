<?php

namespace App\Http\Controllers;
use App\Models\SubheadAllocation;
use App\Models\Subhead;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;



class SubheadAllocationController extends Controller
{
    public function show()
    {
        return view('content.pages.subhead.add-subhead');
    }

    public function upload_bulk_subheads()
    {
        return view('content.pages.subhead.upload-bulk-subheads');
    }

    public function upload_subheads()
    {
        return view('content.pages.subhead.upload-bulk-subheads');
    }


    public function AllSubheadAllocations()
    {
        return view('content.pages.subhead.all-subhead-allocations');
    }

    public function SubheadAllocations()
    {
        return view('content.pages.subhead.subhead-allocation');
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
        'department_id' => 'required|string',
        'approved_provision' => 'required|string'
      ]);



      try {
        $subhead = new Subhead();
        $subhead->head_id = $request->head_id;
        $subhead->subhead_code = $request->subhead_code;
        $subhead->subhead_name = $request->subhead_name;
        $subhead->remarks = $request->remarks;
        $subhead->department_id = $request->department_id;
        $subhead->approved_provision = $request->approved_provision;
        $subhead->created_by = auth()->id();
        $subhead->save();
      } catch (QueryException $exception) {
        return redirect()->back()->with('error', 'An error occurred while saving the subhead.');
    }

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
            ->select('subhead.*', 'department.department_name', 'users.name', 'head.*')
            ->leftjoin('department', 'department.id', '=', 'subhead.department_id')
            ->leftjoin('users', 'users.id', '=', 'subhead.created_by')
            ->leftjoin('head', 'head.id', '=', 'subhead.head_id')
            ->paginate(20); // You can change the number '10' to the desired number of items per page.

        return view('content.pages.subhead.subheads', compact('subheads'));
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


  
  public function copySubhead(Request $request)
{
    try {
        // Retrieve records from the source table
        $records = Subhead::all();

        // Initialize an array to store existing records
        $existingRecords = [];

        // Loop through the records
        foreach ($records as $record) {
            // Check if a record with the same data already exists in the destination table
            $existingRecord = SubheadAllocation::
            where('subhead_id', $record->id)
            ->where('department_id', Auth::user()->department_id)
            ->first();

            // If a record with the same data exists, add it to the existing records array
            if ($existingRecord) {
                $existingRecords[] = $existingRecord;
            } else {
                // If a record with the same data doesn't exist, create a new record in the destination table
                $newRecord = new SubheadAllocation();

                // Copy data from the source record to the new record
                $newRecord->subhead_id = $record->id;
                $newRecord->department_id = Auth::user()->department_id;
                // Copy other columns as needed

                // Save the new record
                $newRecord->save();
            }
        }

        // If there are existing records, return them in the error response
        if (!empty($existingRecords)) {
            return response()->json(['message' => 'Some records already exist.', 'existing_records' => $existingRecords], 409);
        }

        return response()->json(['message' => 'Records copied successfully']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error copying records: ' . $e->getMessage()], 500);
    }
}

// Update Subhead Allocation
public function updateSubheadAllocation(Request $request, $id)
{
  if (SubheadAllocation::where('id', $id)->exists()) {
    $subhead_allocation = SubheadAllocation::find($id);
    $subhead_allocation->approved_provision = is_null($request->approved_provision) ? $subhead_allocation->approved_provision : $request->approved_provision;
    $subhead_allocation->revised_provision = is_null($request->revised_provision) ? $subhead_allocation->revised_provision : $request->revised_provision;

    $subhead_allocation->save();
    return redirect()->back()->with('success', "Subhead Allocation successfuly updated.");
}
}


}