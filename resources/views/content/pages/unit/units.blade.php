@extends('layouts/contentNavbarLayout')

@section('title', 'Units')

@section('content')
<a href="/add-unit" ><button type="button" class="btn btn-primary" style="float: right">[+] New Unit</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Units /</span> All Units
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Units</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Unit ID</th>
            <th>Unit Name</th>
            <th>Department</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($units as $data)
          <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->unit_name}}</td>
            <td>{{$data->department_name ?? 'No unit assigned'}}</td>
            {{-- <td>{{$data->department_name}}</td> --}}

            <td>

              {{-- <a data-toggle = "tooltip" title = "See Units"   href="javascript:void(0);"><i class="bx bx-grid me-1"></i> </a> &nbsp; --}}
              <a data-toggle = "tooltip" title = "Edit This Department"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal-{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This Department"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>

          <form action="{{ route('unit.update', [$data->id]) }}" method="PUT" >
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <h5 class="modal-title" id="exampleModalLabel1">Unit Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Unit Name</label>
                        <input type="text" name="unit_name" id="nameBasic" class="form-control" value="{{$data->unit_name}}">
                      </div>
                    </div>
         
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Role</label>
                        <select id="id" class="select2 form-select" name="role_id">
                          <option value="">Select</option>
                          {{$departments =  App\Models\Department::select('department_name', 'id')->get();}}
                          @forelse($departments as $item)
                          <option value="{{$item->id}}" {{ $item->id == $item->id ? 'selected' : '' }}>{{$item->department_name}}</option>
                          @empty
                          @endforelse
                        </select>
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
