@extends('layouts/contentNavbarLayout')

@section('title', 'Add Accounting Year')

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
<a href="/accounting-year"><button type="button" class="btn btn-primary" style="float: right">←Back To Accounting
    Year</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Accounting Year /</span> New Accounting Year
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
      <h5 class="card-header">Accounting Year Capture Form</h5>
      <!-- Account -->

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="{{ route('accounting-year.store') }}" method="POST">
          @csrf



          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="end_month" class="form-label">Start Date</label>
              <input class="form-control" name="start_date" type="month" id="html5-month-input" />

              <script>
                // Get the current date as a string in the format "YYYY-MM"
                const currentDate = new Date().toISOString().slice(0, 7);
                // Set the default value of the datepicker to the current month
                document.getElementById('html5-month-input').value = currentDate;
              </script>

              <!-- Error -->
              @if ($errors->has('start_date'))
              <div class="error">
                {{ $errors->first('start_date') }}
              </div>
              @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="end_month" class="form-label">End Date</label>
              <input class="form-control" name="end_date" type="month" id="html5-month-input2" />

              <script>
                // Get the current date as a string in the format "YYYY-MM"
                const currentDate = new Date().toISOString().slice(0, 7);
                // Set the default value of the datepicker to the current month
                document.getElementById('html5-month-input2').value = currentDate;
              </script>

             <!-- Error -->
              @if ($errors->has('end_date'))
              <div class="error">
                {{ $errors->first('end_date') }}
              </div>
              @endif
            </div>
          </div>


          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="accounting_year_name" class="form-label">Accounting Year Name</label>
              <select id="year" name="accounting_year_name" class="form-control">
                <option value="">Select Accounting Year Name</option>
                <!-- Generate a list of years from 1900 to the next year -->
                <script>
                  var nextYear = new Date().getFullYear() + 1;
                  for (var year = 2022; year <= nextYear; year++) {
                    document.write('<option value="' + year + '">' + year + '</option>');
                  }
                </script>
              </select>

              <!-- Error -->
              @if ($errors->has('accounting_year_name'))
              <div class="error">
                {{ $errors->first('accounting_year_name') }}
              </div>
              @endif
            </div>


            <div class="mb-3 col-md-6">
              <label for="zipCode" class="form-label">Comments</label>
              <textarea class="form-control" id="comment" name="comment"></textarea>
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
