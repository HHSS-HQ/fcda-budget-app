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
<a href="/units"><button type="button" class="btn btn-primary" style="float: right">←Back To Units</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Projects /</span> Project Report
</h4>

<div class="row">
  <div class="col-md-12">

    <div class="card mb-4">
      {{-- <h5 class="card-header">Unit Capture Form</h5> --}}

      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="{{ route('project.report') }}" method="POST">
          @csrf

          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="unit_name" class="form-label">Select Project to Report</label>
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
              <label for="observations" class="form-label">Observations</label>
              <textarea class="form-control {{ $errors->has('observations') ? 'error' : '' }}" name="observations"></textarea>
              @if ($errors->has('observations'))
              <div class="error">
                {{ $errors->first('observations') }}
              </div>
              @endif
            </div>
          </div>

          <div class="mb-3 col-md-6">
            <label for="remarks" class="form-label">Comments</label>
            <textarea class="form-control {{ $errors->has('remarks') ? 'error' : '' }}" name="comment"></textarea>
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
