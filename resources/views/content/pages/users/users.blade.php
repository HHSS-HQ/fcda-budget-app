@extends('layouts/contentNavbarLayout')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('title', 'Tables - Basic Tables')

@section('content')
<a href="/add-role" ><button type="button" class="btn btn-primary" style="float: right">[+] New User</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Users /</span> All Users
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Users</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      

      @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ @session('success') }}  
      </div>
      @endif

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $data)
          <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->username}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->role_name ?? 'No role assigned'}}</td>

            <td>

              <a data-toggle = "tooltip" title = "Edit This User"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This User"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>
          @empty
                <tr>
                  <td colspan="5" style="color:red">Oops! No roles registered yet</td>
                </tr>

          @endforelse


        </tbody>
      </table>

      <form action="{{ route('user.update', [$data->id]) }}" method="PUT">
      <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              
              <h5 class="modal-title" id="exampleModalLabel1">User Edit Form</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Username</label>
                  <input type="text" name="username" id="nameBasic" class="form-control" value="{{$data->username}}" readonly>
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="emailBasic" class="form-label">Fullname</label>
                  <input type="text" name="name" id="emailBasic" class="form-control" value="{{$data->name}}">
                </div>
                <div class="col mb-0">
                  <label for="dobBasic" class="form-label">Email</label>
                  <input type="text" name="email" id="dobBasic" class="form-control" value="{{$data->email}}" >
                </div>
              </div>

              
              {{-- <div class="mb-3 col-md-6">
                <label class="form-label" for="country">Role</label>
                <select id="id" class="select2 form-select">
                  <option value="">Select</option>
                  {{$roles =  App\Models\Role::select('role_name', 'id')->get();}}
                  @forelse($roles as $item)
                  <option value="{{$item->id}}">{{$item->role_name}}</option>
                  @empty
                  @endforelse
                </select>
              </div> --}}

              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Role</label>
                  <select id="id" class="select2 form-select" name="role_id">
                    <option value="">Select</option>
                    {{$roles =  App\Models\Role::select('role_name', 'id')->get();}}
                    @forelse($roles as $item)
                    <option value="{{$item->id}}">{{$item->role_name}}</option>
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
    </div>
  </div>
</div>
<!--/ Bordered Table -->


<!--/ Responsive Table -->
@endsection
