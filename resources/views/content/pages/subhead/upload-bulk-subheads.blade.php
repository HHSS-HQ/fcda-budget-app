@extends('layouts/contentNavbarLayout')

@section('title', 'Upload Bulk Subhead')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
@livewireStyles




@endsection

@if(session('success'))
<div style="   top: 5; float: right;" class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500">
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
<div style="  position: -webkit-sticky;  top: 0; float: right;" class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500">
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
  <span class="text-muted fw-light">Subheads /</span> Upload Bulk Subheads
</h4>

<div class="row">
  <div class="col-md-12">
    {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Connections</a></li>
    </ul> --}}
    <div class="card mb-4">
      <h5 class="card-header">Bulk Upload Form</h5>

      <hr class="my-0">
      <div class="card-body">
        
        <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
          @csrf
{{-- 
          <div class="mb-3 col-md-6">
            <label for="unit_name" class="form-label">Select Head</label>
            <select id="id" class="select2 form-control" name="head_id" required>
              <option value="">Select Head</option>
              {{$projects =  App\Models\Head::select('head_name', 'id', 'head_code')->get();}}
              @forelse($projects as $item)
              <option value="{{$item->id}}">{{$item->head_code}}-{{$item->head_name}}</option>
              @empty
              @endforelse
            </select>
            <!-- Error -->
            @if ($errors->has('project_title'))
            <div class="error">
              {{ $errors->first('project_title') }}
            </div>
            @endif
          </div> --}}


          {{-- <div class="mb-3 col-md-6">
            <label for="department_name" class="form-label">Select Department</label>
            <select id="id" class="select2 form-control" name="department_id" required>
              <option value="">Select Department</option>
              {{$departments =  App\Models\Department::select('department_name', 'id')->get();}}
              @forelse($departments as $item)
              <option value="{{$item->id}}">{{$item->department_name}}</option>
              @empty
              @endforelse
            </select>
            <!-- Error -->
            @if ($errors->has('department_name'))
            <div class="error">
              {{ $errors->first('department_name') }}
            </div>
            @endif
          </div> --}}

          <div class="form-group">
            
              <label for="file">Choose Excel File</label>
              <input type="file" name="file" id="file" class="form-control" required>
          </div>

          <input type="text" hidden name="created_by" value="{{ Auth::user()->id }}"/>
          <input type="text" hidden name="department_id" value="{{ Auth::user()->department_id }}"/>
          <br/>
          <button type="submit" class="btn btn-primary">Import</button>
      </form>
        
      </div>
      <!-- /Account -->
    </div>

  </div>
</div>
@endsection
