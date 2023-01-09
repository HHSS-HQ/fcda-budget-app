@extends('layouts/contentNavbarLayout')

@section('title', 'Add Project')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
@livewireStyles

@endsection
@if(session('success'))
<div style="  position: -webkit-sticky; position: sticky; top: 0; float: right;" class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500">
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
<a href="/departments" ><button type="button" class="btn btn-primary" style="float: right">←Back To Units</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Units /</span> New Unit
</h4>

<div class="row">
  <div class="col-md-12">
    {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Connections</a></li>
    </ul> --}}
    <div class="card mb-4">
      <h5 class="card-header">Unit Capture Form</h5>

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="" action="{{ route('unit.store') }}" method="POST" >
          @csrf



          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="unit_name" class="form-label">Unit Name</label>
              <input class="form-control {{ $errors->has('unit_name') ? 'error' : '' }}" type="text" id="unit_name" name="unit_name" autofocus placeholder="Unit Name"/>
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
        @if ($errors->has('unit_name'))
        <div class="error">
            {{ $errors->first('unit_name') }}
        </div>
        @endif
            </div>


           
            <div class="mb-3 col-md-6">
              <label for="remarks" class="form-label">Remarks</label>
              {{-- <input class="form-control {{ $errors->has('role_name') ? 'error' : '' }}" type="text" id="role_name" name="role_name" autofocus placeholder="Role Name"/> --}}
<textarea class="form-control {{ $errors->has('remarks') ? 'error' : '' }}" name="remarks"></textarea>
              @if ($errors->has('remarks'))
              <div class="error">
              {{ $errors->first('remarks') }}
             </div>
              @endif
            </div>
          </div>


          <div class="row">
            <div class="col mb-3">
              <label for="nameBasic" class="form-label">Department</label>
              <select id="id" class="select2 form-select" name="department_id">
                <option value="">Select</option>
                {{$departments =  App\Models\Department::select('department_name', 'id')->get();}}
                @forelse($departments as $item)
                <option value="{{$item->id}}">{{$item->department_name}}</option>
                @empty
                @endforelse
              </select>
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
