@extends('layouts/contentNavbarLayout')

@section('title', 'Roles')

@section('content')
<a href="/add-role" ><button type="button" class="btn btn-primary" style="float: right">[+] New Role</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Roles /</span> All Roles
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Roles</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">

      <table class="table table-bordered">
        @php $i=1; @endphp
        <thead>
          <tr>
            <th>Role ID</th>
            <th>Role Name</th>

            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($roles as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->role_name}}</td>

            <td>

              <a data-toggle = "tooltip" title = "Edit This Role"   href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This Role"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>
          @empty
                <tr>
                  <td colspan="5" style="color:red">Oops! No roles registered yet</td>
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
