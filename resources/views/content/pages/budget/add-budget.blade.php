@extends('layouts/contentNavbarLayout')

@section('title', 'Add Budget')

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
<a href="/budgets"><button type="button" class="btn btn-primary" style="float: right">←Back To Budgets</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Budgets /</span> New Budget
</h4>

<div class="row">
  <div class="col-md-12">
    {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i
      class="bx bx-bell me-1"></i> Notifications</a></li>
    <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i
          class="bx bx-link-alt me-1"></i> Connections</a></li>
    </ul> --}}
    <div class="card mb-4">
      <h5 class="card-header">Budget Capture Form</h5>

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="" action="{{ route('budget.store') }}" method="POST">
          @csrf

          <div class="row">

            <div class="col mb-3">
              <label for="nameBasic" class="form-label">Accounting Year</label>
              <select id="project_type_id" class="select2 form-select" name="budget_year">
                <option value="">Select Accounting Year</option>
                {{$accounting_year =  App\Models\AccountingYear::select('accounting_year_name', 'start_date', 'end_date', 'id')->get();}}
                @forelse($accounting_year as $item)
                <option value="{{$item->id}}">{{$item->accounting_year_name}}
                  ({{ Carbon\Carbon::createFromFormat('Y-m', $item->start_date)->format('F, Y') }}-{{ Carbon\Carbon::createFromFormat('Y-m', $item->end_date)->format('F, Y') }})
                </option>
                @empty
                @endforelse
              </select>
            </div>

            <div class="mb-3 col-md-6">
              <label for="appropriated_amount" class="form-label">Appropriated Amount</label>
              <input class="form-control {{ $errors->has('appropriated_amount') ? 'error' : '' }}" type="text"
                id="appropriated_amount" name="appropriated_amount" autofocus placeholder="Appropriated Amount"
                oninput="this.value = formatNumber(this.value);" onchange="this.value = stripCommas(this.value);">

              <script>
                function formatNumber(num) {
                  num = num.replace(/[^\d\.]/g, ''); // remove non-numeric characters except for the decimal point
                  if (num === '') {
                    return '';
                  }
                  const parts = num.split('.');
                  parts[0] = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                  return parts.join('.');
                }

                function stripCommas(num) {
                  return num.replace(/,/g, '');
                }
              </script>

              {{-- <input class="form-control {{ $errors->has('appropriated_amount') ? 'error' : '' }}"
              type="number"id="appropriated_amount" name="appropriated_amount" autofocus placeholder="Appropriated
              Amount" /> --}}
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
              @if ($errors->has('appropriated_amount'))
              <div class="error">
                {{ $errors->first('appropriated_amount') }}
              </div>
              @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Code</label>
              <input class="form-control {{ $errors->has('code') ? 'error' : '' }}" type="text" id="code" name="code"
                autofocus placeholder="Code" />
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
              @if ($errors->has('code'))
              <div class="error">
                {{ $errors->first('code') }}
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
