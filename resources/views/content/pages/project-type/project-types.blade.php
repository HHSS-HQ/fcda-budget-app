@extends('layouts/contentNavbarLayout')

@section('title', 'Project Type')

@section('content')
<a href="/add-project-type" ><button type="button" class="btn btn-primary" style="float: right">[+] New Project Type</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Project Type /</span> All Project Types
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Project Types</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Project Type ID</th>
            <th>Project Type</th>
            <th>Status </th>
            {{-- <th>Code </th> --}}

            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($project_types as $data)
          <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->project_type}}</td>
           
            <td>{{$data->status}}</td>
            {{-- <td>&#8358;{{ number_format($data->appropriated_amount ? : '0', 2) }}</td> --}}

            <td>

              {{-- <a data-toggle = "tooltip" title = "See Units"   href="javascript:void(0);"><i class="bx bx-grid me-1"></i> </a> &nbsp; --}}
              <a data-toggle = "tooltip" title = "Edit This Department"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal-{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This Department"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>

          <form action="{{ route('project-type.update', [$data->id]) }}" method="PUT" >
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <h5 class="modal-title" id="exampleModalLabel1">Project Type Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Project Type</label>
                        <input type="text" name="subhead_code" id="nameBasic" class="form-control" value="{{$data->project_type}}">
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
                  <td colspan="5" style="color:red">Oops! No project types registered yet</td>
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
