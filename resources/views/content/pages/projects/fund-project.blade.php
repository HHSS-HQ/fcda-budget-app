@extends('layouts/contentNavbarLayout')

@section('title', 'Add Unit')

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
<a href="/releases"><button type="button" class="btn btn-primary" style="float: right">←Back To Projects</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Projects /</span> Fund Project
</h4>

<div class="row">
  <div class="col-md-12">

    <div class="card mb-4">

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="{{ route('fund-project.store') }}" method="POST">
          @csrf

          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="unit_name" class="form-label">Select Project to Fund</label>
              <select id="id" class="select2 form-control" name="project_id">
                <option value="">Select</option>
                {{$projects =  App\Models\Project::select('project_title', 'id')->get();}}
                @forelse($projects as $item)
                <option value="{{$item->id}}">{{$item->project_title}}</option>
                @empty
                @endforelse
              </select>
              <!-- Error -->
              @if ($errors->has('project_title'))
              <div class="error">
                {{ $errors->first('project_title') }}
              </div>
              @endif
            </div>


            <div class="mb-3 col-md-6">
              <label for="amount" class="form-label">Amount Released</label>
              <input class="form-control {{ $errors->has('amount') ? 'error' : '' }}" type="text"
                id="amount" name="amount" autofocus placeholder="Amount To Fund"
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
              <!-- Error -->
              @if ($errors->has('amount'))
              <div class="error">
                {{ $errors->first('amount') }}
              </div>
              @endif
            </div>
          </div>

          <div class="mb-3 col-md-6">
            <label for="remarks" class="form-label">Comments</label>
            <textarea class="form-control {{ $errors->has('comment') ? 'error' : '' }}" name="comment"></textarea>
            @if ($errors->has('comment'))
            <div class="error">
              {{ $errors->first('comment') }}
            </div>
            @endif
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
