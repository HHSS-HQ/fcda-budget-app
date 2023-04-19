@extends('layouts/contentNavbarLayout')

@section('title', 'Accounting Year')

@section('content')
<a href="/add-accounting-year" ><button type="button" class="btn btn-primary" style="float: right">[+] New Accounting Year</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Accounting Year /</span> All Years
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">Account Year</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Year ID</th>
            <th>Year Name</th>
            <th>Start Month</th>
            <th>End Month</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($accounting_year as $data)
          <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->accounting_year_name}}</td>
            <td>{{ Carbon\Carbon::createFromFormat('Y-m', $data->start_date)->format('F, Y') }}</td>
            <td>{{ Carbon\Carbon::createFromFormat('Y-m', $data->end_date)->format('F, Y') }}</td>
            <td>

              <a data-toggle = "tooltip" title = "Edit This Role"   href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This Role"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>
          @empty
                <tr>
                  <td colspan="5" style="color:red">Oops! No accounting year registered yet</td>
                </tr>

          @endforelse


        </tbody>
      </table>
    </div>
  </div>
</div>
<!--/ Bordered Table -->


<!--/ Responsive Table -->
@endsection
