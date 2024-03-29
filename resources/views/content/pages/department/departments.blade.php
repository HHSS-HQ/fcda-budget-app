
@extends('layouts/contentNavbarLayout')

@section('title', 'Departments')

@section('content')
<a href="/add-department" ><button type="button" class="btn btn-primary" style="float: right">[+] New Department</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Departments /</span> All Departments
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Departments</h5>
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
            <th>Budget Utilization</th>
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
          $budget_utilization = App\Models\ECF::selectRaw('SUM(present_requisition) as total')->where('department_id', $data->id)->where('budget_id', $data->budget_id)->first();


          @endphp

          <tr>
            <td><?php echo $i++; ?></td>

            <td>{{$data->department_name}}</td>
            <td>{{$data->department_code ?? null}}</td>
            <td>N{{number_format(($active_budget->budgetary_allocation ?? null),2)}}</td>
            <td>N{{number_format(($budget_utilization->total ?? null),2)}}</td>
            <td>N{{number_format(($active_budget->budgetary_allocation-$budget_utilization->total),2)}}</td>
            <td>{{number_format((($budget_utilization->total/$active_budget->budgetary_allocation )*100),2)}}%</td>
            {{-- <td></td> --}}
            <td>
              <a data-toggle = "tooltip" title = "See Breakdown of Budget utilization"   href="/budget-utilization?id={{$data->id}}">[<i class="bx bx-search me-1"></i>Utilization]</a>&nbsp;
              @if ($active_budget->budgetary_allocation == NULL)
              <a data-toggle = "tooltip" title = "Add Budget"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addBudget-{{$data->id}}">[<i class="bx bx-plus me-1"></i>Add Budget]</a>&nbsp;
              @else
              <a data-toggle = "tooltip" title = "Update Budget"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#updateBudget-{{$data->id}}">[<i class="bx bx-plus me-1"></i>Update Budget]</a>&nbsp;
              @endif


              <a data-toggle = "tooltip" title = "Edit This Department"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal-{{$data->id}}">[<i class="bx bx-edit-alt me-1"></i>Edit]</a>&nbsp;
              <a data-toggle = "tooltip" title = "Delete This Department"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>

          <form action="{{ route('department.update', [$data->id]) }}" method="PUT" >
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel1">Department Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Department Name</label>
                        <input type="text" name="department_name" id="nameBasic" class="form-control" value="{{$data->department_name}}">
                      </div>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            </form>


            <form action="{{ route('department_budget.update', [$active_budget->id]) }}" method="PUT" >
              <div class="modal fade" id="updateBudget-{{$data->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="exampleModalLabel1">Department Budget Edit Form</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Budgetary Allocation</label>

                          <input type="text" name="budgetary_allocation" id="nameBasic" class="form-control" value="{{$active_budget->budgetary_allocation}}">
                        </div>
                      </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
              </form>




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
                          <input type="hidden" name="parent_budget_id" value="{{$active_budget->id}}" class="form-control">
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
