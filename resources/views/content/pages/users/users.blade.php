@extends('layouts/contentNavbarLayout')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('title', 'Users')

@section('content')
<a href="/add-user" ><button type="button" class="btn btn-primary" style="float: right">[+] New User</button></a>
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


      
      {{-- <form action="{{ route('user.update')}}" method="PUT"> --}}
        {{-- <form action="" method="PUT"> --}}
          {{-- <form action="{{ route('user.update', [$data->id]) }}" method="PUT" > --}}
            <form action="" method="PUT" id="editForm">
          <div class="modal fade" id="basicModal-2" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel1">User Edit Form</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col mb-3">
                                  <label for="username" class="form-label">Username</label>
                                  <input type="text" name="username" id="username" class="form-control" readonly value="">
                              </div>
                              <div class="col mb-3">
                                  <label for="name" class="form-label">Fullname</label>
                                  <input type="text" name="name" id="name" class="form-control" value="">
                              </div>
                          </div>

                          <div class="row">
                            <div class="col mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control"  value="">
                            </div>
                        
                        </div>


                          <div class="row">
                            <div class="row">
                              <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Role</label>
                                <select id="id" class="select2 form-select" name="role_id">
                                  <option value="">Select</option>
                                  {{$roles =  App\Models\Role::select('role_name', 'id')->get();}}
                                  @forelse($roles as $item)
                                  <option value="{{$item->id}}" {{ $item->id == $item->id ? 'selected' : '' }}>{{$item->role_name}}</option>
                                  @empty
                                  @endforelse
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col mb-3">
                              <label for="nameBasic" class="form-label">Department</label>
                              <select id="id" class="select2 form-select" name="department_id">
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
      

      
      
      <table class="table table-bordered users-datatable">
        <thead>
            <tr>
                <th>SN</th>
                {{-- <th>UserID</th> --}}
                <th>Username</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Department</th>
                {{-- <th>Extra</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

      
    </div>
  </div>
</div>
<!--/ Bordered Table -->

<script>
  // JavaScript to update role ID input field value when edit button is clicked
  $(document).on('click', '.edit', function () {
      var name = $(this).data('name');
      var username = $(this).data('username');
      var userId = $(this).data('id');
      var email = $(this).data('email'); // Get the role ID from the data attribute of the edit button
      $('#name').val(name);
      $('#username').val(username);
      $('#email').val(email);
      $('#editForm').attr('action', '/update-user/' + userId); // Set the value of the role ID input field
  });
</script>
<!--/ Responsive Table -->
@endsection
