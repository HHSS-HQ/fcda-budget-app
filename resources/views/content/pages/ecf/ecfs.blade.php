@extends('layouts/contentNavbarLayout')

@section('title', 'Departments')

@section('content')
<a href="/add-ecf" ><button type="button" class="btn btn-primary" style="float: right">[+] New ECF</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">ECF /</span> All ECFs
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All ECFs</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ECF ID</th>
            <th>Expenditure Item</th>
            <th>Department Name</th>
            <th>Subhead Name</th>
            <th>Present Requisition</th>
            <th>Payee </th>
            <th>Status </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($ecfs as $data)
          <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->expenditure_item}}</td>
            <td>{{$data->department->dept_name}}</td>
            <td>{{$data->subhead->subhead_name}}</td>
            <td>&#8358;{{$data->present_requisition}}</td>
            <td>{{$data->payee->payee_name}}</td>
            <td>{{$data->status}}</td>

            <td>

              <a data-toggle = "tooltip" title = "Print ECF"   href="javascript:void(0);"><i class="bx bx-printer me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Edit This ECF"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal-{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This ECF"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>

          <form action="{{ route('department.update', [$data->id]) }}" method="PUT" >
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel1">ECF Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Department</label>
                        <input type="text" name="department_id" id="nameBasic" class="form-control" value="{{$data->department->dept_name}}">
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
                  <td colspan="5" style="color:red">Oops! No ECF created yet</td>
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
