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

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>SN</th>
            <th>Department Name</th>
            <th>Department Code</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i="1";
          @endphp
          @forelse($departments as $data)
          <tr>
            <td>@php echo $i++ @endphp</td>
            <td>{{$data->department_name}}</td>
            <td>{{$data->department_code ?? null}}</td>
            <td>
              <a data-toggle = "tooltip" title = "See Budget utilization"   href="/budget-utilization?id={{$data->id}}"><i class="bx bx-search me-1"></i>Budget Utilization </a> &nbsp;
              <a data-toggle = "tooltip" title = "See Units"   href="javascript:void(0);"><i class="bx bx-grid me-1"></i> Units</a> &nbsp;
              <a data-toggle = "tooltip" title = "Edit This Department"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal-{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> Edit</a> &nbsp;
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
