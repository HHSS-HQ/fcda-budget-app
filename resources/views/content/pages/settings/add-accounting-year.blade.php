@extends('layouts/contentNavbarLayout')

@section('title', 'Add Accounting Year')

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
<a href="/accounting-year" ><button type="button" class="btn btn-primary" style="float: right">←Back To Accounting Year</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Accounting Year /</span> New Accounting Year
</h4>

<div class="row">
  <div class="col-md-12">
    {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Connections</a></li>
    </ul> --}}
    <div class="card mb-4">
      <h5 class="card-header">Accounting Year Capture Form</h5>
      <!-- Account -->

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings"  action="{{ route('accounting-year.store') }}" method="POST" >
          @csrf



          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="accounting_year_name" class="form-label">Accounting Year Name</label>
              <select id="year" name="year" class="form-control">
                <option value="">Select Accounting Year Name</option>
                <!-- Generate a list of years from 1900 to the next year -->
                <script>
                  var nextYear = new Date().getFullYear() + 1;
                  for (var year = 2022; year <= nextYear; year++) {
                    document.write('<option value="' + year + '">' + year + '</option>');
                  }
                </script>
              </select>
              {{-- <input class="form-control {{ $errors->has('accounting_year_name') ? 'error' : '' }}" type="text" id="accounting_year_name" name="accounting_year_name" autofocus placeholder="Accounting Year Name"/> --}}
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
              @if ($errors->has('accounting_year_name'))
              <div class="error">
              {{ $errors->first('accounting_year_name') }}
             </div>
              @endif
            </div>
          </div>

          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="start_month" class="form-label"></label>
              <select id="start_month" name="start_month" class="form-control"></select>
              <script>
                $(document).ready(function() {
                  var months = [
                    "January", "February", "March", "April",
                    "May", "June", "July", "August",
                    "September", "October", "November", "December"
                  ];

                  var $select = $('#start_month');
                  $select.append('<option value="">Select Start Month</option>');
                  for (var i = 0; i < months.length; i++) {
                    $select.append('<option value="' + months[i] + '">' + months[i] + '</option>');
                  }
                  $select.select2({
                    placeholder: "Select Start Month",
                    allowClear: true
                  });
                });
              </script>
              {{-- <input class="form-control {{ $errors->has('accounting_year_name') ? 'error' : '' }}" type="text" id="accounting_year_name" name="accounting_year_name" autofocus placeholder="Accounting Year Name"/> --}}
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
              @if ($errors->has('start_month'))
              <div class="error">
              {{ $errors->first('start_month') }}
             </div>
              @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="end_month" class="form-label"></label>
              <select id="end_month" name="end_month" class="select2 form-control"></select>
              <script>
                $(document).ready(function() {
                  var months = [
                    "January", "February", "March", "April",
                    "May", "June", "July", "August",
                    "September", "October", "November", "December"
                  ];

                  var $select = $('#end_month');
                  $select.append('<option value="">Select End Month</option>');
                  for (var i = 0; i < months.length; i++) {
                    $select.append('<option value="' + months[i] + '">' + months[i] + '</option>');
                  }
                  $select.select2({
                    placeholder: "Select End Month",
                    allowClear: true
                  });
                });
              </script>
              {{-- <input class="form-control {{ $errors->has('accounting_year_name') ? 'error' : '' }}" type="text" id="accounting_year_name" name="accounting_year_name" autofocus placeholder="Accounting Year Name"/> --}}
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
              @if ($errors->has('end_month'))
              <div class="error">
              {{ $errors->first('end_month') }}
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



<script>
  $(document).ready(function() {
  $('.select2').select2();
});
</script>
@endsection
