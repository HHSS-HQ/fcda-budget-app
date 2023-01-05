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
<a href="/projects" ><button type="button" class="btn btn-primary" style="float: right">←Back To Projects</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Project /</span> New Project
</h4>

<div class="row">
  <div class="col-md-12">
    {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Connections</a></li>
    </ul> --}}
    <div class="card mb-4">
      <h5 class="card-header">Project Capture Form</h5>
      <!-- Account -->
      {{-- <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Project Images</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>

            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
          </div>
        </div>
      </div> --}}
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="" action="{{ route('project.store') }}" method="POST" >
          @csrf



          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="project_title" class="form-label">Project Title</label>
              <input class="form-control {{ $errors->has('project_title') ? 'error' : '' }}" type="text" id="project_title" name="project_title" autofocus placeholder="Project Title"/>
            <!-- Error -->
        @if ($errors->has('project_title'))
        <div class="error">
            {{ $errors->first('project_title') }}
        </div>
        @endif
            </div>


            <div class="mb-3 col-md-6">
              <label for="project_location" class="form-label">Project Location</label>
              <input class="form-control {{ $errors->has('project_location') ? 'error' : '' }}" type="text" name="project_location" id="project_location" placeholder="Project Location"/>
                        <!-- Error -->
        @if ($errors->has('project_location'))
        <div class="error">
            {{ $errors->first('project_location') }}
        </div>
        @endif
            </div>


            <div class="mb-3 col-md-6">
              <label for="contractor_name" class="form-label">Contractor Name</label>
              <input class="form-control" type="text" id="contractor_name" name="contractor_name" placeholder="Contractor Name"/>
            </div>


            <div class="mb-3 col-md-6">
              <label for="date_of_award" class="form-label">Date of Award</label>
              <input type="date" class="form-control" id="date_of_award" name="date_of_award"/>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="appropriation">Appropriation</label>
              <div class="input-group input-group-merge">
                {{-- <span class="input-group-text">US (+1)</span> --}}
                <input type="number" id="appropriation" name="appropriation" class="form-control" placeholder="0.00" />
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="contract_sum" class="form-label">Contract Sum</label>
              <input type="number" class="form-control" id="contract_sum" name="contract_sum" placeholder="0.00" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="commencement_date" class="form-label">Commencement Date</label>
              <input class="form-control" type="date" id="commencement_date" name="commencement_date" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="completion_period" class="form-label">Completion Period</label>
              <input type="text" class="form-control" id="completion_period" name="completion_period" placeholder="Completion Period"  />
            </div>

            <div class="mb-3 col-md-6">
              <label for="percentage_complete" class="form-label">Percentage Complete</label>
              <input type="number" class="form-control" id="percentage_completion" name="percentage_completion" placeholder="%" maxlength="6" />
            </div>

            <div class="mb-3 col-md-6">
              <label for="amount_paid_till_date" class="form-label">Amount Paid Till Date</label>
              <input type="number" class="form-control" id="amount_paid_till_date" name="amount_paid_till_date" placeholder="0.00" maxlength="9" />
            </div>

            <div class="mb-3 col-md-6">
              <label for="outstanding_balance" class="form-label">Outstanding Balance </label>
              <input type="number" class="form-control" id="outstanding_balance" name="outstanding_balance" placeholder="0.00" maxlength="9" />
            </div>

            <div class="mb-3 col-md-6">
              <label for="certified_cv_not_paid" class="form-label">Certified CV Not Paid</label>
              <input type="text" class="form-control" id="certified_cv_not_paid" name="certified_cv_not_paid" placeholder="Certified CV Not Paid" />
            </div>

            <div class="mb-3 col-md-6">
              <label for="year_last_funded" class="form-label">Year Last Funded</label>
              <input type="date" class="form-control" id="year_last_funded" name="year_last_funded"  />
            </div>

            <div class="mb-3 col-md-6">
              <label for="last_funded_date" class="form-label">Last Funded Date</label>
              <input type="date" class="form-control" id="last_funded_date" name="last_funded_date"  />
            </div>


            <div class="mb-3 col-md-6">
              <label for="observations" class="form-label">Observations</label>
              <textarea class="form-control" id="observations" name="observations" ></textarea>
            </div>
            {{-- <input type="text" class="form-control" id="observations" name="observations" placeholder="231465" maxlength="6" /> --}}

            <div class="mb-3 col-md-6">
              <label for="challenges" class="form-label">Challenges </label>
              <textarea class="form-control" id="challenges" name="challenges" ></textarea>
              {{-- <input type="text" class="form-control" id="challenges" name="challenges" placeholder="231465" maxlength="6" /> --}}
            </div>
{{-- 
            <div class="mb-3 col-md-6">
              <label for="zipCode" class="form-label">Completion Period</label>
              <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" maxlength="6" />
            </div> --}}

            <div class="mb-3 col-md-6">
              <label for="zipCode" class="form-label">Recommendations</label>
              <textarea class="form-control" id="recommendations" name="recommendations" ></textarea>
              {{-- <input type="text" class="form-control" id="recommendations" name="recommendations" placeholder="Recommendations"  /> --}}
            </div>

            <div class="mb-3 col-md-6">
              <label for="project_year" class="form-label">Project Year</label>
              <input type="date" class="form-control" id="project_year" name="project_year" />
            </div>

            {{-- <div class="mb-3 col-md-6">
              <label class="form-label" for="country">Country</label>
              <select id="country" class="select2 form-select">
                <option value="">Select</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Belarus">Belarus</option>
                <option value="Brazil">Brazil</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Korea">Korea, Republic of</option>
                <option value="Mexico">Mexico</option>
                <option value="Philippines">Philippines</option>
                <option value="Russia">Russian Federation</option>
                <option value="South Africa">South Africa</option>
                <option value="Thailand">Thailand</option>
                <option value="Turkey">Turkey</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
              </select>
            </div> --}}
            {{-- <div class="mb-3 col-md-6">
              <label for="language" class="form-label">Language</label>
              <select id="language" class="select2 form-select">
                <option value="">Select Language</option>
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="pt">Portuguese</option>
              </select>
            </div> --}}
            {{-- <div class="mb-3 col-md-6">
              <label for="timeZones" class="form-label">Timezone</label>
              <select id="timeZones" class="select2 form-select">
                <option value="">Select Timezone</option>
                <option value="-12">(GMT-12:00) International Date Line West</option>
                <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                <option value="-10">(GMT-10:00) Hawaii</option>
                <option value="-9">(GMT-09:00) Alaska</option>
                <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                <option value="-7">(GMT-07:00) Arizona</option>
                <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                <option value="-6">(GMT-06:00) Central America</option>
                <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                <option value="-6">(GMT-06:00) Saskatchewan</option>
                <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                <option value="-5">(GMT-05:00) Indiana (East)</option>
                <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                <option value="-4">(GMT-04:00) Caracas, La Paz</option>
              </select>
            </div> --}}
            {{-- <div class="mb-3 col-md-6">
              <label for="currency" class="form-label">Currency</label>
              <select id="currency" class="select2 form-select">
                <option value="">Select Currency</option>
                <option value="usd">USD</option>
                <option value="euro">Euro</option>
                <option value="pound">Pound</option>
                <option value="bitcoin">Bitcoin</option>
              </select>
            </div> --}}
          </div>
          {{-- <div>
            <button wire:click="submit">Checkout</button>
         
            <div wire:loading.delay.long>
                Processing Payment...
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
