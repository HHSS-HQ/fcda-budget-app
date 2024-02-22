@extends('layouts/contentNavbarLayout')

{{-- <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
@section('title', 'Subhead')
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
@section('content')
<div>

<span><a href="/add-subhead" ><button type="button" class="btn btn-primary" >[+] New Subhead</button></a> </span>
<span> <a href="/upload-bulk-subheads" ><button type="button" class="btn btn-danger" >[^] Upload Bulk Subheads</button></a></span>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Subhead /</span> All Subheads
</h4>


<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Subheads</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      {{-- <table id="subheadsTable" class="table table-bordered"> --}}

        {{-- <div class="mb-3">
          <label for="globalSearch" class="form-label">Global Search:</label>
          <input type="text" class="form-control" id="globalSearch">
      </div> --}}

      
      <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>SN</th>
                <th>Subhead Code</th>
                <th>Subhead Name</th>
                {{-- <th>Department</th>
                <th>Approved Provision</th> --}}
                {{-- <th>DOB</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

   
    </div>
  </div>
</div>
@endsection

@section('scripts')

@endsection


