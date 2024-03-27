
@extends('layouts/contentNavbarLayout')

@section('title', 'Departments')

@section('content')
<a href="/add-department" ><button type="button" class="btn btn-primary" style="float: right">[+] New Department</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Departments /</span> All Departments Budget
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Departments Budget</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <div class="text-end mb-3">
        <a href="{{ route('departments.export.excel') }}" class="btn btn-primary">Download as Excel</a>
        <a href="{{ route('departments.export.pdf') }}" class="btn btn-primary">Download as PDF</a>
      </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>SN</th>
            <th>Department Name</th>
            <th>Department Code</th>
            <th>Budget Allocation</th>
            <th>Total Expenditure</th>
            <th>Budget Balance</th>
            <th>Utilization %</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i="1";
          @endphp
          @forelse($departments as $data)



          @php

          $active_budget = App\Models\DepartmentBudget::select('budgetary_allocation', 'id')->where('department_id', '=', $data->id)->first();
          // $budget_utilization = App\Models\ECF::selectRaw('SUM(present_requisition) as total')->where('department_id', $data->id)->where('budget_id', $data->budget_id)->first();

          $budget_utilization = App\Models\Transactions::selectRaw('SUM(transaction_amount) as transaction_amount')->where('department_id', $data->id)->where('budget_id', $data->budget_id)->first();

          @endphp

          <tr>
            <td><?php echo $i++; ?></td>

            <td>{{$data->department_name ?? null}}</td>
            <td>{{$data->department_code ?? null}}</td>
            <td>N{{number_format(($active_budget->budgetary_allocation ?? null),2)}}</td>
            <td>N{{number_format(($budget_utilization->transaction_amount ?? null),2)}}</td>
            <td>N{{ number_format((($active_budget->budgetary_allocation ?? 0) - ($budget_utilization->transaction_amount ?? 0)), 2) }}</td>

            @if(isset($active_budget) && isset($budget_utilization))
    @php
        $budgetary_allocation = $active_budget->budgetary_allocation ?? 0;
        $transaction_amount = $budget_utilization->transaction_amount ?? 0;

        // Calculate the percentage of budget utilization
        $utilization_percentage = ($transaction_amount / $budgetary_allocation) * 100;
    @endphp

    
    <td><div class="progress mb-3">
      <div class="progress-bar" role="progressbar" style="width: {{ $utilization_percentage }}%;" aria-valuenow="{{ $utilization_percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $utilization_percentage }}%</div>
    </div></td>
@else
    <td>N/A</td>
@endif

            <td>
              <a data-toggle = "tooltip" title = "See Breakdown of Budget utilization"   href="/budget-utilization?id={{$data->id}}">[<i class="bx bx-search me-1"></i>Utilization]</a>&nbsp;
              @if ($active_budget->budgetary_allocation == NULL or 0)
              <a data-toggle = "tooltip" title = "Add Budget"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addBudget-{{$data->id}}">[<i class="bx bx-plus me-1"></i>Add Budget]</a>&nbsp;
              @elseif ($active_budget->budgetary_allocation == !NULL)
              <a data-toggle = "tooltip" title = "Update Budget"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#updateBudget-{{$data->id}}">[<i class="bx bx-plus me-1"></i>Update Budget]</a>&nbsp;
              @endif


              <a data-toggle = "tooltip" title = "Edit This Department"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal-{{$data->id}}">[<i class="bx bx-edit-alt me-1"></i>Edit]</a>&nbsp;
              <a data-toggle = "tooltip" title = "Delete This Department"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>

         




            <form action="{{ route('department_budget.store', [$data->id]) }}" method="POST" >
              @csrf
              <div class="modal fade" id="addBudget-{{$data->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="exampleModalLabel1">Add Budget</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col mb-3">
                          {{-- <label for="nameBasic" class="form-label">Select Budget</label> --}}

                          {{-- {{$active_budget =  App\Models\Budget::select('id')->where('status', '=', 'ACTIVE')->get(); }} --}}
                      @php
                      $active_budget = App\Models\Budget::select('id')->where('status', '=', 'ACTIVE')->first();
                      @endphp
                          <input type="hidden" name="parent_budget_id" value="{{$active_budget->id ?? null}}" class="form-control">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Budget Allocation</label>
                          <input type="text" name="budgetary_allocation" id="nameBasic" class="form-control" >
                        </div>
                      </div>

                      <div class="row">
                        <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Remarks</label>
                          <textarea name="remarks" class="form-control"></textarea>
                        </div>
                      </div>

                   </div>


                   <input type="hidden" value="{{$data->id}}" name="department_id" />

                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
              </form>

          @empty
                <tr>
                  <td colspan="5" style="color:red">Oops! No departments registered yet</td>
                </tr>

          @endforelse


        </tbody>
      </table>
    </div>
  </div>
</div>
<!--/ Bordered Table -->


<!--/ Responsive Table -->
@endsection
