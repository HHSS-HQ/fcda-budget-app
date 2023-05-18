@extends('layouts/contentNavbarLayout')

@section('title', 'Add Contractor')

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


@if(session('error'))
<div style="  position: -webkit-sticky; position: sticky; top: 0; float: right;"
  class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500">
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
<a href="/contractors"><button type="button" class="btn btn-primary" style="float: right">←Back To Contractors</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Contractor /</span> New Contractor
</h4>

<div class="row">
  <div class="col-md-12">

    <div class="card mb-4">
      <h5 class="card-header">Contractor Capture Form</h5>

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="" action="{{ route('contractor.store') }}" method="POST">
          @csrf

          <div class="row">

            <div class="col mb-3">
              <label for="nameBasic" class="form-label">Company Name</label>
              <input class="form-control {{ $errors->has('company_name') ? 'error' : '' }}" type="text" id="company_name" name="company_name"  autofocus placeholder="Company Name" />
            @if ($errors->has('company_name'))
            <div class="error">
              {{ $errors->first('company_name') }}
            </div>
            @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="contractor_name" class="form-label">Contractor Name</label>
              <input class="form-control {{ $errors->has('contractor_name') ? 'error' : '' }}" type="text" id="contractor_name" name="contractor_name" placeholder="Contractor Name" />
              @if ($errors->has('contractor_name'))
              <div class="error">
                {{ $errors->first('contractor_name') }}
              </div>
              @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Contractor Account Number </label>
              <input class="form-control {{ $errors->has('contractor_account_number') ? 'error' : '' }}" type="text" id="contractor_account_number" name="contractor_account_number" placeholder="Contractor Account Number" />
              @if ($errors->has('contractor_account_number'))
              <div class="error">
                {{ $errors->first('contractor_account_number') }}
              </div>
              @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Contractor Account Name </label>
              <input class="form-control {{ $errors->has('contractor_account_name') ? 'error' : '' }}" type="text" id="contractor_account_name" name="contractor_account_name" placeholder="Contractor Account Name" />
              @if ($errors->has('contractor_account_name'))
              <div class="error">
                {{ $errors->first('contractor_account_name') }}
              </div>
              @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Account Name</label>
              <input class="form-control {{ $errors->has('payee_account_name') ? 'error' : '' }}" type="text" id="payee_account_name" name="payee_account_name" placeholder="Account Name" />
              @if ($errors->has('payee_account_name'))
              <div class="error">
                {{ $errors->first('payee_account_name') }}
              </div>
              @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="remarks" class="form-label">Bank</label>
              <select name="payee_bank" class="form-control">
                <option value="">Select a bank</option>
                <option value="Access Bank">Access Bank</option>
                <option value="Fidelity Bank">Fidelity Bank</option>
                <option value="First Bank of Nigeria">First Bank of Nigeria</option>
                <option value="Guaranty Trust Bank">Guaranty Trust Bank</option>
                <option value="Union Bank of Nigeria">Union Bank of Nigeria</option>
                <option value="United Bank for Africa">United Bank for Africa</option>
                <option value="Zenith Bank">Zenith Bank</option>
                <option value="Stanbic IBTC Bank">Stanbic IBTC Bank</option>
                <option value="Sterling Bank">Sterling Bank</option>
                <option value="Ecobank Nigeria">Ecobank Nigeria</option>
                <option value="Heritage Bank">Heritage Bank</option>
                <option value="Keystone Bank">Keystone Bank</option>
                <option value="Polaris Bank">Polaris Bank</option>
                <option value="Wema Bank">Wema Bank</option>
                <option value="Unity Bank">Unity Bank</option>
                <option value="Citibank Nigeria">Citibank Nigeria</option>
                <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                <option value="SunTrust Bank">SunTrust Bank</option>
                <option value="Providus Bank">Providus Bank</option>
                <option value="Opay">Opay</option>
                <option value="Kuda">Kuda</option>
                <option value="Taj Bank">Taj Bank</option>
                <option value="Coronation Merchant Bank">Coronation Merchant Bank</option>
                <option value="Rand Merchant Bank">Rand Merchant Bank</option>
                <option value="Nova Merchant Bank">Nova Merchant Bank</option>
                <option value="Globus Bank">Globus Bank</option>
                <option value="Titan Trust Bank">Titan Trust Bank</option>
                <option value="Jaiz Bank">Jaiz Bank</option>
                <option value="SunTrust Bank">SunTrust Bank</option>
                <!-- Add more banks here -->
              </select>


            </div>


            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Primary Phone Number</label>
              <input class="form-control {{ $errors->has('contractor_phone_number') ? 'error' : '' }}" type="text" id="contractor_phone_number" name="contractor_phone_number" placeholder="Primary Phone Number" />
              @if ($errors->has('contractor_phone_number'))
              <div class="error">
                {{ $errors->first('contractor_phone_number') }}
              </div>
              @endif
            </div>


            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Alternate Phone Number</label>
              <input class="form-control {{ $errors->has('alternate_phone_number') ? 'error' : '' }}" type="text" id="alternate_phone_number" name="alternate_phone_number" placeholder="Alternate Phone Number" />
              @if ($errors->has('alternate_phone_number'))
              <div class="error">
                {{ $errors->first('alternate_phone_number') }}
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
