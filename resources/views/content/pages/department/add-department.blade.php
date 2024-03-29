@extends('layouts/contentNavbarLayout')

@section('title', 'Add Department')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
@livewireStyles

@endsection
@if(session('success'))
<div style="  position: -webkit-sticky; position: sticky; top: 0; float: right;"
  class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500">
  {{-- <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"> --}}
  <div class="toast-header">
    <i class='bx bx-bell me-2'></i>
    <div class="me-auto fw-semibold">Success</div>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    {{ @session('success') }}
  </div>
</div>

@endif
@section('content')
@livewireScripts
<a href="/departments"><button type="button" class="btn btn-primary" style="float: right">←Back To
    Departments</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Departments /</span> New Department
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Department Capture Form</h5>

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="" action="{{ route('department.store') }}" method="POST">
          @csrf

          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="department_name" class="form-label">Department Name</label>
              <input class="form-control {{ $errors->has('department_name') ? 'error' : '' }}" type="text"
                id="department_name" name="department_name" autofocus placeholder="Department Name" />
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
              @if ($errors->has('department_name'))
              <div class="error">
                {{ $errors->first('department_name') }}
              </div>
              @endif
            </div>


            <div class="mb-3 col-md-6">
              <label for="department_name" class="form-label">Department Code</label>
              <input class="form-control {{ $errors->has('department_code') ? 'error' : '' }}" type="number"
                id="department_code" name="department_code" autofocus placeholder="Department Code" />
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
              @if ($errors->has('department_code'))
              <div class="error">
                {{ $errors->first('department_code') }}
              </div>
              @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="remarks" class="form-label">Remarks</label>
              {{-- <input class="form-control {{ $errors->has('role_name') ? 'error' : '' }}" type="text" id="role_name"
              name="role_name" autofocus placeholder="Role Name"/> --}}
              <textarea class="form-control {{ $errors->has('remarks') ? 'error' : '' }}" name="remarks"></textarea>
              @if ($errors->has('remarks'))
              <div class="error">
                {{ $errors->first('remarks') }}
              </div>
              @endif
            </div>
          </div>

          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>

  </div>
</div>
@endsection
