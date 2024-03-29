@extends('layouts/contentNavbarLayout')

@section('title', 'Add Subhead')

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

@if(session('error'))
<div style="  position: -webkit-sticky; position: sticky; top: 0; float: right;" class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500">
  {{-- <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"> --}}
  <div class="toast-header">
    <i class='bx bx-bell me-2'></i>
    <div class="me-auto fw-semibold">Error</div>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
   {{ @session('error') }}
  </div>
</div>
@endif


@section('content')
@livewireScripts
<a href="/subheads" ><button type="button" class="btn btn-primary" style="float: right">←Back To Subheads</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Subheads /</span> New Subhead
</h4>

<div class="row">
  <div class="col-md-12">
    {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Connections</a></li>
    </ul> --}}
    <div class="card mb-4">
      <h5 class="card-header">Subhead Capture Form</h5>

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="" action="{{ route('subhead.store') }}" method="POST" >
          @csrf


      {{-- <select id="id" class="select2 form-select" name="department_id">
                <option value="">Select</option>
                {{$departments =  App\Models\Department::select('department_name', 'id')->get();}}
                @forelse($departments as $item)
                <option value="{{$item->id}}">{{$item->department_name}}</option>
                @empty
                @endforelse
              </select> --}}

          <div class="row">

            <div class="mb-3 col-md-6">
              <label for="subhead_code" class="form-label">Budget Year</label>
         <select id="id" class="select2 form-select" name="department_id">
                {{-- <option value="">Select</option> --}}
                {{$departments =  App\Models\AccountingYear::select('accounting_year_name', 'start_date', 'end_date', 'id')->where('status', '=', 'ACTIVE')->get();}}
                @forelse($departments as $item)
                <option value="{{$item->id}}">{{$item->accounting_year_name}} ({{ Carbon\Carbon::createFromFormat('Y-m', $item->start_date)->format('F, Y') }}-{{ Carbon\Carbon::createFromFormat('Y-m', $item->end_date)->format('F, Y') }}) </option>
                @empty
                @endforelse
              </select>
              <span style="color:red">Current active budget automatically selected. Click dropdown to select a different year</span>
            </div>


            <div class="mb-3 col-md-6">
              <label for="subhead_code" class="form-label">Department</label>
         <select id="id" class="select2 form-select" name="department_id">
                <option value="">Select</option>
                {{$departments =  App\Models\Department::select('department_name', 'id')->get();}}
                @forelse($departments as $item)
                <option value="{{$item->id}}">{{$item->department_name}}</option>
                @empty
                @endforelse
              </select>
            </div>

            <div class="mb-3 col-md-6">
              <label for="subhead_code" class="form-label">Head</label>
         <select id="id" class="select2 form-select" name="head_id">
                <option value="">Select</option>
                {{$departments =  App\Models\Head::select('head_name', 'id')->get();}}
                @forelse($departments as $item)
                <option value="{{$item->id}}">{{$item->head_name}}</option>
                @empty
                @endforelse
              </select>
            </div>

            <div class="mb-3 col-md-6">
              <label for="subhead_code" class="form-label">Subhead Code</label>
              <input class="form-control {{ $errors->has('subhead_code') ? 'error' : '' }}"  type="text"  id="subhead_code" name="subhead_code" autofocus placeholder="Subhead Code"/>
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
               @if ($errors->has('subhead_code'))
              <div class="error">
                {{ $errors->first('subhead_code') }}
              </div>
            @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="subhead_name" class="form-label">Subhead Name</label>
              <input class="form-control {{ $errors->has('subhead_name') ? 'error' : '' }}"  type="text" id="subhead_name" name="subhead_name" autofocus placeholder="Subhead Name"/>
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
        @if ($errors->has('subhead_name'))
        <div class="error">
            {{ $errors->first('subhead_name') }}
        </div>
        @endif
            </div>


            <div class="mb-3 col-md-6">
              <label for="approved_provision" class="form-label">Subhead Appropriation</label>
              <input class="form-control {{ $errors->has('approved_provision') ? 'error' : '' }}"  type="number"  id="approved_provision" name="approved_provision" autofocus placeholder="Subhead Amount"/>
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
               @if ($errors->has('approved_provision'))
              <div class="error">
                {{ $errors->first('approved_provision') }}
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


          {{-- <div class="row">
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
          </div> --}}

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
