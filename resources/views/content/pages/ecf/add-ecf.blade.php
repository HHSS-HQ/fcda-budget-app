@extends('layouts/contentNavbarLayout')

@section('title', 'Add Department')

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
<a href="/ecfs" ><button type="button" class="btn btn-primary" style="float: right">←Back To ECFs</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">ECFs /</span> New ECF
</h4>

<div class="row">
  <div class="col-md-12">
    {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Connections</a></li>
    </ul> --}}
    <div class="card mb-4">
      <h5 class="card-header">ECF Capture Form</h5>

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="" action="{{ route('ecf.store') }}" method="POST" >
          @csrf


        <div class="row">
            <div class="col mb-3">
              <label for="nameBasic" class="form-label">Department</label>
              {{-- <select id="id" class="select2 form-select" name="department_id">
                <option value="">Select</option>
                {{$departments =  App\Models\Department::select('department_name', 'id')->get();}}
                @forelse($departments as $item)
                <option value="{{$item->id}}">{{$item->department_name}}</option>
                @empty
                @endforelse
              </select> --}}

              <select id="department_dropdown" class="select2 form-select" name="department_id">
                <option value="">-- Select Department --</option>
                @foreach ($departments as $data)
                <option value="{{$data->id}}">
                    {{$data->department_name}}
                </option>
                @endforeach
            </select>

            </div>

            <div class="mb-3 col-md-6">
              <label for="subhead_name" class="form-label">Subhead</label>

        <div class="form-group mb-3">
          <select id="subhead_dropdown" name="subhead_id" class="select2 form-select">
          </select>
      </div>

            </div>


          </div>

          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="expenditure_item" class="form-label">Expenditure Item</label>
              <input class="form-control {{ $errors->has('expenditure_item') ? 'error' : '' }}" type="text" id="expenditure_item" name="expenditure_item" autofocus placeholder="Expenditure Item"/>
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
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
              <input class="form-control {{ $errors->has('present_requisition') ? 'error' : '' }}" type="number" id="present_requisition" name="present_requisition" autofocus placeholder="Present Requisition"/>
              {{-- <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span> --}}
              <!-- Error -->
        @if ($errors->has('present_requisition'))
        <div class="error">
            {{ $errors->first('present_requisition') }}
        </div>
        @endif
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
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Department Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#department_dropdown').on('change', function () {
            var idCountry = this.value;
            $("#subhead_dropdown").html('');
            $.ajax({
                url: "{{url('fetch-subhead')}}",
                type: "POST",
                data: {
                    department_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#subhead_dropdown').html('<option value="">-- Select Subhead --</option>');
                    $.each(result.subheads, function (key, value) {
                        $("#subhead_dropdown").append('<option value="' + value
                            .id + '">' + value.subhead_name + '</option>');
                    });
                    $('#approved_provision').html('None found');
                }
            });
        });

        /*------------------------------------------
        --------------------------------------------
        Subhead Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#subhead_dropdown').on('change', function () {
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
                success: function (res) {
                    $('#approved_provision').html('');
                    $.each(res.approved_provisions, function (key, value) {
                        $("#approved_provision").append('<option value="' + value
                            .approved_provision + '">' + value.approved_provision + '</option>');
                    });
                }
            });
        });


        $('#subhead_dropdown').on('change', function () {
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
                success: function (res) {
                    $('#revised_provision').html('');
                    $.each(res.revised_provisions, function (key, value) {
                        $("#revised_provision").append('<option value="' + value
                            .revised_provision + '">' + value.revised_provision + '</option>');
                    });
                }
            });
        });

    });
</script>
