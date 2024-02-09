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


      
      <form action="{{ route('user.update'" method="PUT" >
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
                    <input type="text" name="username" id="username" class="form-control" readonly>
                  </div>
                </div>

              </div></div></div></div></form>
      
      <table class="table table-bordered users-datatable">
        <thead>
            <tr>
                <th>SN</th>
                <th>Username</th>
                <th>Username</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Department</th>
                <th>Extra</th>
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


<!--/ Responsive Table -->
@endsection
