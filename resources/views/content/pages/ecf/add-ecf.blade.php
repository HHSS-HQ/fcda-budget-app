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
<a href="/ecfs"><button type="button" class="btn btn-primary" style="float: right">←Back To ECFs</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">ECFs /</span> New ECF
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">ECF Capture Form</h5>

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="" action="{{ route('ecf.store') }}" method="POST">
          @csrf

          <div class="row">
            <div class="col mb-3">
              <label for="nameBasic" class="form-label">Department</label>
              <select id="department_dropdown" class="select2 form-select" name="department_id">
                <option value="">-- Select Department --</option>
                @foreach ($departments as $data)
                <option value="{{$data->id}}">
                  {{$data->department_name}}
                </option>
                @endforeach
              </select>
            </div>

          </div>

          <div class="row">

            <div class="mb-3 col-md-6">
              <label for="head_dropdown" class="form-label">Head</label>
              <select id="head_dropdown" class="select2 form-select" name="head_id">
                <option value="">---Select Head---</option>
                @php
                $heads =  App\Models\Head::select('head_name', 'id')->get();
                @endphp
                @forelse($heads as $item)
                <option value="{{$item->id}}">{{$item->head_name}}</option>
                @empty
                @endforelse
              </select>
            </div>

            <div class="mb-3 col-md-6">
              <label for="subhead_dropdown" class="form-label">Subhead</label>

              <div class="form-group mb-3">
                <select id="subhead_dropdown" name="subhead_id" class="select2 form-select">
                  <option value="">-- Select Subhead --</option>
                </select>
              </div>
            </div>


            <div class="mb-3 col-md-6">
              <label for="expenditure_item" class="form-label">Expenditure Item (Description)</label>
              <input class="form-control {{ $errors->has('expenditure_item') ? 'error' : '' }}" type="text"
                id="expenditure_item" name="expenditure_item" autofocus placeholder="Expenditure Item (Description)" />
              @if ($errors->has('department_name'))
              <div class="error">
                {{ $errors->first('department_name') }}
              </div>
              @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="approved_provision" class="form-label">Approved Provision</label>
              <select id="approved_provision" name="approved_provision" class="form-control" @readonly(true)>
              </select>
            </div>

            <div class="mb-3 col-md-6">
              <label for="revised_provision" class="form-label">Payee</label>
              <select id="id" class="select2 form-select" name="payee_id">
                <option value="">---Select Payee---</option>
                {{$payees =  App\Models\Payee::select('payee_name', 'id')->get();}}
                @forelse($payees as $item)
                <option value="{{$item->id}}">{{$item->payee_name}}</option>
                @empty
                @endforelse
              </select>
            </div>

            <div class="mb-3 col-md-6">
              <label for="revised_provision" class="form-label">Revised Provision</label>
              <select id="revised_provision" name="revised_provision" class="form-control" @readonly(true)>
              </select>
            </div>

          </div>
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="present_requisition" class="form-label">Present Requisition</label>
              <input class="form-control {{ $errors->has('present_requisition') ? 'error' : '' }}" type="number"
                id="present_requisition" name="present_requisition" autofocus placeholder="Present Requisition" />
              @if ($errors->has('present_requisition'))
              <div class="error">
                {{ $errors->first('present_requisition') }}
              </div>
              @endif
            </div>
            <?php
            $expenditure_till_date = App\Models\ECF::selectRaw('SUM(ecf.present_requisition) as expenditure_till_date')->get();
            ?>




            <div class="mb-3 col-md-6">
              <ul>
                <li>Budgetary Allocation: <b><span id="budgetary_allocation"></span></b></li>
                <li>Expenditure Till Date: <b></b></li>
                {{-- <li>Expenditure Till Date: <b>N{{number_format($expenditure_till_date->first()->expenditure_till_date, 2)}}</b></li> --}}
                <li>Current Balance: </li>
                <li>Balance Carried Forward: </li>
              </ul>
<input type="hidden" name="department_budget_id" />

              </select>
            </div>

            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">Generate ECF</button>
              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
        </form>
      </div>
      <!-- /Account -->
    </div>

  </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    /*------------------------------------------
    --------------------------------------------
    Department Dropdown Change Event
    --------------------------------------------
    --------------------------------------------*/



$('#head_dropdown').on('change', function() {
  var department_id = $('#department_dropdown').val();
  var head_id = $(this).val();

  $('#subhead_dropdown').html('<option value="">-- Select Subhead --</option>');
  $('#approved_provision').html('None found');

  if (department_id && head_id) {
    $.ajax({
      url: "{{ url('fetch-subhead') }}",
      type: "POST",
      data: {
        department_id: department_id,
        head_id: head_id,
        _token: '{{ csrf_token() }}'
      },
      dataType: 'json',
      success: function(result) {
        $.each(result.subheads, function(key, value) {
          $("#subhead_dropdown").append('<option value="' + value.id + '">' + '[' + value.subhead_code + '] - ' + value.subhead_name + '</option>');
        });
      }
    });

    // Retrieve department budget and append to span
    $.ajax({
      url: "{{ url('fetch-department-budget') }}",
      type: "POST",
      data: {
        department_id: department_id,
        _token: '{{ csrf_token() }}'
      },
      dataType: 'json',
      success: function(result) {
        $("#budgetary_allocation").text(result);
      }
    });
  } else {
    // Display an error message
    alert('Please select both a department and a head.');
  }

  $.ajax({
  url: "{{ url('fetch-department-budget-id') }}",
  type: "POST",
  data: {
    department_id: department_id,
    _token: '{{ csrf_token() }}'
  },
  dataType: 'json',
  success: function(result) {
    $("input[name='department_budget_id']").val(result);
  }
});



});

    // Retrieve department budget and append to span





    /*------------------------------------------
    --------------------------------------------
    Subhead Dropdown Change Event
    --------------------------------------------
    --------------------------------------------*/
    $('#subhead_dropdown').on('change', function() {
      var idState = this.value;
      $("#approved_provision").html('');
      $.ajax({
        url: "{{url('fetch-approved-provision')}}",
        type: "POST",
        data: {
          subhead_id: idState,
          _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function(res) {
          $('#approved_provision').html('');
          $.each(res.approved_provisions, function(key, value) {
            $("#approved_provision").append('<option value="' + value
              .approved_provision + '">' + value.approved_provision + '</option>');
          });
        }
      });
    });
    $('#subhead_dropdown').on('change', function() {
  var idState = this.value;
  $("#revised_provision").html('');
  $.ajax({
    url: "{{url('fetch-revised-provision')}}",
    type: "POST",
    data: {
      subhead_id: idState,
      _token: '{{csrf_token()}}'
    },
    dataType: 'json',
    success: function(res) {
      $('#revised_provision').html('');
      $.each(res.revised_provisions, function(key, value) {
        var revisedProvision = value.revised_provision !== null ? value.revised_provision : '0';
        $("#revised_provision").append('<option value="' + revisedProvision + '">' + revisedProvision + '</option>');
      });
    }
  });
});

// Get the id of the selected department
var departmentId = $('#department_dropdown').val();

// Run a query to get the expenditure till date for that department
$.ajax({
  url: "{{url('fetch-expenditure-till-date')}}",
  type: "POST",
  data: {
    department_id: departmentId,
    _token: '{{csrf_token()}}'
  },
  dataType: 'json',
  success: function(res) {
    // Display the expenditure till date beside the expenditure till date list
    $('#expenditure_till_date').text(res.expenditure_till_date);
  }
});

  $('#present_requisition').on('change', function() {
    var presentRequisition = $(this).val();
    var budgetaryAllocation = parseFloat($('#budgetary_allocation').text());

    if (presentRequisition > budgetaryAllocation) {
      alert('The present requisition exceeds the budgetary allocation.');
    }
  });

  });




</script>
