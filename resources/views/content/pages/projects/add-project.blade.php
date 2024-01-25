@extends('layouts/contentNavbarLayout')

@section('title', 'Add Project')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>

<!-- Include the Select2 CSS file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include the Select2 JS file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
<a href="/projects"><button type="button" class="btn btn-primary" style="float: right">←Back To Projects</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Project /</span> New Project
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
      <h5 class="card-header">Project Capture Form</h5>
      <!-- Account -->

  <hr class="my-0">
  <div class="card-body">
    <form id="formAccountSettings" action="" action="{{ route('project.store') }}" method="POST">
      @csrf

      <div class="row">
        <div class="col mb-3">
          <label for="nameBasic" class="form-label">Project Type</label>
          <select id="project_type_id" class="select2 form-select" name="project_type_id">
            <option value="">Select Project Type</option>
            {{$project_types =  App\Models\ProjectType::select('project_type', 'id')->get();}}
            @forelse($project_types as $item)
            <option value="{{$item->id}}">{{$item->project_type}}</option>
            @empty
            @endforelse
          </select>
        </div>
      </div>



      <div class="row">
        <div class="mb-3 col-md-6">
          <label for="project_title" class="form-label">Project Title</label>
          <input class="form-control {{ $errors->has('project_title') ? 'error' : '' }}" type="text" id="project_title"
            name="project_title" autofocus placeholder="Project Title" />
          <!-- Error -->
          @if ($errors->has('project_title'))
          <div class="error">
            {{ $errors->first('project_title') }}
          </div>
          @endif
        </div>

        <div class="mb-3 col-md-6">
          <label for="project_location" class="form-label">Project Location</label>
          <input class="form-control {{ $errors->has('project_location') ? 'error' : '' }}" type="text"
            name="project_location" id="project_location" placeholder="Project Location" />
          <!-- Error -->
          @if ($errors->has('project_location'))
          <div class="error">
            {{ $errors->first('project_location') }}
          </div>
          @endif
        </div>



        <div class="mb-3 col-md-6">
          <label for="company_RC_number" class="form-label">Company RC Number</label>
          <input class="form-control {{ $errors->has('company_RC_number') ? 'error' : '' }}" type="text" id="company_RC_number"
            name="company_RC_number" autofocus placeholder="Company RC Number" />
          <!-- Error -->
          @if ($errors->has('company_RC_number'))
          <div class="error">
            {{ $errors->first('company_RC_number') }}
          </div>
          @endif
        </div>

        <div class="mb-3 col-md-6">
          <label for="file_number" class="form-label">File Number</label>
          <input class="form-control {{ $errors->has('file_number') ? 'error' : '' }}" type="text"
            name="file_number" id="file_number" placeholder="File Number" />
          <!-- Error -->
          @if ($errors->has('file_number'))
          <div class="error">
            {{ $errors->first('file_number') }}
          </div>
          @endif
        </div>



        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Contractor Name</label>
            <select id="id" class="select2 form-select" name="contractor_id">
              <option value="">Select Contractor</option>
              {{$contractor =  App\Models\Contractor::select('company_name', 'id')->get();}}
              @forelse($contractor as $item)
              <option value="{{$item->id}}">{{$item->company_name}}</option>
              @empty
              @endforelse
            </select>
            {{-- <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addContractor" style="color:green">+ Add Contractor</a> --}}
          </div>
        </div>




        <div class="mb-3 col-md-6">
          <label for="date_of_award" class="form-label">Date of Award</label>
          <input type="date" class="form-control" id="date_of_award" name="date_of_award" />
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
          <input type="text" class="form-control" id="completion_period" name="completion_period"
            placeholder="Completion Period" />
        </div>

        {{-- <div class="mb-3 col-md-6">
          <label for="percentage_complete" class="form-label">Percentage Complete</label>
          <input type="number" class="form-control" id="percentage_completion" name="percentage_completion"
            placeholder="%" maxlength="6" />
        </div>

        <div class="mb-3 col-md-6">
          <label for="amount_paid_till_date" class="form-label">Amount Paid Till Date</label>
          <input type="number" class="form-control" id="amount_paid_till_date" name="amount_paid_till_date"
            placeholder="0.00" maxlength="9" />
        </div>

        <div class="mb-3 col-md-6">
          <label for="outstanding_balance" class="form-label">Outstanding Balance </label>
          <input type="number" class="form-control" id="outstanding_balance" name="outstanding_balance"
            placeholder="0.00" maxlength="9" />
        </div> --}}

        <div class="mb-3 col-md-6">
          <label for="certified_cv_not_paid" class="form-label">Certified CV Not Paid</label>
          <input type="text" class="form-control" id="certified_cv_not_paid" name="certified_cv_not_paid"
            placeholder="Certified CV Not Paid" />
        </div>

        <div class="mb-3 col-md-6">
          <label for="year_last_funded" class="form-label">Year Last Funded</label>
          <input type="date" class="form-control" id="year_last_funded" name="year_last_funded" />
        </div>

        {{-- <div class="mb-3 col-md-6">
          <label for="last_funded_date" class="form-label">Last Funded Date</label>
          <input type="date" class="form-control" id="last_funded_date" name="last_funded_date" />
        </div> --}}

        {{-- <div class="mb-3 col-md-6">
          <label for="observations" class="form-label">Observations</label>
          <textarea class="form-control" id="observations" name="observations"></textarea>
        </div>


        <div class="mb-3 col-md-6">
          <label for="challenges" class="form-label">Challenges </label>
          <textarea class="form-control" id="challenges" name="challenges"></textarea>
        </div>


        <div class="mb-3 col-md-6">
          <label for="zipCode" class="form-label">Recommendations</label>
          <textarea class="form-control" id="recommendations" name="recommendations"></textarea>
        </div> --}}

        <div class="mb-3 col-md-6">
          <label for="project_year" class="form-label">Project Year</label>
          <input type="date" class="form-control" id="project_year" name="project_year" />
        </div>





      </div>


      <div class="mt-2">
        <button type="submit" class="btn btn-primary me-2">Save changes</button>
        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
      </div>
    </form>

    {{-- Add Contractor Modal --}}

    <form action="{{ route('contractor.store') }}" method="post">
      @csrf
      <div class="modal fade" id="addContractor" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel1">Add Contractor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Company Name</label>
                  <input type="text" name="company_name" class="form-control">
                </div>

                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Contractor Name</label>
                  <input type="text" name="contractor_name" class="form-control">
                </div>


              </div>
            </div>


            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Contractor Account Number</label>
                  <input type="text" name="contractor_account_number" class="form-control">
                </div>

                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Contractor Account Name</label>
                  <input type="text" name="contractor_account_name" class="form-control">
                </div>
              </div>
            </div>



            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Contractor Bank</label>
                  <select class="select2 form-select" name="contractor_bank">
                    <option value="">Select a bank</option>
                    <option value="Access Bank">Access Bank</option>
                    <option value="Citibank Nigeria Limited">Citibank Nigeria Limited</option>
                    <option value="Coronation Merchant Bank Limited">Coronation Merchant Bank Limited</option>
                    <option value="Ecobank Nigeria">Ecobank Nigeria</option>
                    <option value="Fidelity Bank Nigeria">Fidelity Bank Nigeria</option>
                    <option value="First Bank of Nigeria">First Bank of Nigeria</option>
                    <option value="First City Monument Bank">First City Monument Bank</option>
                    <option value="Globus Bank Limited">Globus Bank Limited</option>
                    <option value="Guaranty Trust Bank">Guaranty Trust Bank</option>
                    <option value="Heritage Bank Plc">Heritage Bank Plc</option>
                    <option value="Keystone Bank Limited">Keystone Bank Limited</option>
                    <option value="Nova Merchant Bank Limited">Nova Merchant Bank Limited</option>
                    <option value="Polaris Bank Limited">Polaris Bank Limited</option>
                    <option value="Providus Bank Limited">Providus Bank Limited</option>
                    <option value="Rubies Bank">Rubies Bank</option>
                    <option value="Stanbic IBTC Bank">Stanbic IBTC Bank</option>
                    <option value="Standard Chartered Bank Nigeria Limited">Standard Chartered Bank Nigeria Limited</option>
                    <option value="Sterling Bank">Sterling Bank</option>
                    <option value="SunTrust Bank Nigeria Limited">SunTrust Bank Nigeria Limited</option>
                    <option value="Titan Trust Bank Limited">Titan Trust Bank Limited</option>
                    <option value="Union Bank of Nigeria">Union Bank of Nigeria</option>
                    <option value="United Bank for Africa">United Bank for Africa</option>
                    <option value="Unity Bank Plc">Unity Bank Plc</option>
                    <option value="Wema Bank">Wema Bank</option>
                    <option value="Zenith Bank">Zenith Bank</option>
                  </select>

                </div>
              </div>
            </div>

            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Contractor Phone Number</label>
                  <input type="text" name="contractor_phone_number" class="form-control">
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    {{-- <form method="post">
      @csrf
      <div class="modal fade" id="addContractor" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel1">Add Contractor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nameBasic" class="form-label">Company Name</label>
                  <input type="text" name="company_name" class="form-control">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="addContractorButton">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form> --}}


  </div>
  <!-- /Account -->
</div>

</div>
</div>

<script>
  // Submit the form data to the correct URL when the "Save changes" button is clicked
  document.getElementById('addContractorButton').addEventListener('click', function() {
    // Get the form data
    var formData = new FormData(document.querySelector('#addContractor form'));

    // Send an AJAX request to the correct URL
    fetch('/contractor.store', {
      method: 'POST',
      body: formData
    })
    .then(function(response) {
      if (response.ok) {
        // Update the select dropdown with the new contractor
        var contractorId = response.text();
        var contractorName = formData.get('company_name');
        var option = document.createElement('option');
        option.value = contractorId;
        option.textContent = contractorName;
        document.querySelector('#id').appendChild(option);

        // Close the modal
        var modal = document.querySelector('#addContractor');
        var bootstrapModal = bootstrap.Modal.getInstance(modal);
        bootstrapModal.hide();
      } else {
        // Display an error message
        alert('Error: ' + response.statusText);
      }
    })
    .catch(function(error) {
      // Display an error message
      alert('Error: ' + error.message);
    });
  });




</script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script>
  $(document).ready(function() {
  $('.select2').select2();
});
</script>

@endsection
