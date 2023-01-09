@extends('layouts/contentNavbarLayout')

@section('title', 'Budget')

@section('content')
<a href="/add-budget" ><button type="button" class="btn btn-primary" style="float: right">[+] New Budget</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Budget /</span> All Budgets
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Budgets</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Budget ID</th>
            <th>Budget Year</th>
            <th>Appropriated Amount</th>
            <th>Status </th>
            <th>Code </th>

            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($budgets as $data)
          <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->budget_year}}</td>
            <td>&#8358;{{ number_format($data->appropriated_amount ? : '0', 2) }}</td>
            <td>{{$data->status}}</td>
            <td>{{$data->code}}</td>

            <td>

              {{-- <a data-toggle = "tooltip" title = "See Units"   href="javascript:void(0);"><i class="bx bx-grid me-1"></i> </a> &nbsp; --}}
              <a data-toggle = "tooltip" title = "Edit This Department"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal-{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This Department"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>

          <form action="{{ route('budget.update', [$data->id]) }}" method="PUT" >
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <h5 class="modal-title" id="exampleModalLabel1">Budget Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Budget Year</label>
                        <input type="number" min="2022" max="2040" name="budget_year" id="nameBasic" class="form-control" value="{{$data->budget_year}}">
                      </div>
                    </div>

                    
                      <div class="row">
                        <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Appropriated Amount</label>
                          <input type="number" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" name="appropriated_amount" id="nameBasic" class="form-control" value="{{$data->appropriated_amount}}">
                        </div>
                      </div>
         
                      <div class="row">
                        <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Code</label>
                          <input type="text" name="appropirated_amount" id="nameBasic" class="form-control" value="{{$data->code}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Status</label><br/>
    <input type="radio" id="status1" name="status" value="ACTIVE" {{ $data->status == 'ACTIVE' ? 'selected' : '' }}>
  <label for="status1">Active</label><br>
  <input type="radio" id="status2" name="status" value="INACTIVE" {{ $data->status == "INACTIVE" ? 'selected' : '' }}>
  <label for="status2">Inactive</label><br>  
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
