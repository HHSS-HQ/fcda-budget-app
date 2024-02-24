@extends('layouts/contentNavbarLayout')

{{-- <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
@section('title', 'Subhead')
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
@section('content')
<div>

<span><button type="button" id="copyRecordsBtn" class="btn btn-primary" >[+] New Subhead</button> </span>
{{-- <span> <a href="/upload-bulk-subheads" ><button type="button" class="btn btn-danger" >[^] Upload Bulk Subheads</button></a></span> --}}
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Subhead /</span> All Subhead Allocations
</h4>


<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header"> Subhead Allocations</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      {{-- <table id="subheadsTable" class="table table-bordered"> --}}

        {{-- <div class="mb-3">
          <label for="globalSearch" class="form-label">Global Search:</label>
          <input type="text" class="form-control" id="globalSearch">
      </div> --}}

      <form action="" method="PUT" id="editForm3">
        <div class="modal fade" id="basicModal-3" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subhead_name"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="approved_provision" class="form-label">Approved Provision</label>
                                <input type="text" name="approved_provision" id="approved_provision" class="form-control">
                            </div>
                            <div class="col mb-3">
                                <label for="revised_provision" class="form-label">Revised Provision</label>
                                <input type="text" name="revised_provision" id="revised_provision" class="form-control">
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
      
      <table class="table table-bordered all-subhead-allocation" style="width:100%; table-layout: fixed; word-wrap: break-word; white-space: normal;">
        <thead>
            <tr>
                <th>SN</th>
                <th>Subhead Code</th>
                <th>Subhead Name</th>
                <th>Department</th>
                <th>Approved Provision</th>
                <th>Revised Provision</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

   
    </div>
  </div>
</div>

<script>
  // JavaScript to update role ID input field value when edit button is clicked
  $(document).on('click', '.edit', function () {
      var id = $(this).data('id');
      var department_id = $(this).data('department_id');
      var subhead_name = $(this).data('subhead_name');
      var approved_provision = $(this).data('approved_provision');
       // Get the role ID from the data attribute of the edit button

       $('#id').val(id);
       $('#department_id').val(department_id);
       $('#subhead_name').text(subhead_name);
       $('#approved_provision').val(approved_provision);
       console.log("Hi");
       
      $('#editForm3').attr('action', '/update-subhead-allocation/' + id); // Set the value of the role ID input field
  });
</script>
<style>
  .dataTables_wrapper table {
      width: 100%; /* Set the width of the table */
      table-layout: fixed; /* Use fixed table layout to respect width */
  }

  .dataTables_wrapper table th,
  .dataTables_wrapper table td {
      word-wrap: break-word; /* Enable text wrapping */
  }
</style>
@endsection

@section('scripts')

@endsection


