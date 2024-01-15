@extends('layouts/contentNavbarLayout')

{{-- <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
@section('title', 'Subhead')

@section('content')
<a href="/add-subhead" ><button type="button" class="btn btn-primary" style="float: right">[+] New Subhead</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Subhead /</span> All Subheads
</h4>


<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Subheads</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      {{-- <table id="subheadsTable" class="table table-bordered"> --}}

        <div class="mb-3">
          <label for="globalSearch" class="form-label">Global Search:</label>
          <input type="text" class="form-control" id="globalSearch">
      </div>

      
        <table class="table table-bordered" id="subheadsTable">
          <thead>
              <tr>
                  <th>SN</th>
                  <th>Department</th>
                  <th>Head</th>
                  <th>Subhead Code</th>
                  <th>Subhead Name</th>
                  <th>Appropriation</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
          {{-- @php
            $i="1";
          @endphp --}}
          @forelse($subheads as $data)
          <tr>
            <td></td>
            <td>{{$data->department_name}}</td>
            <td>{{$data->head_code ?? null}} - {{$data->head_name ?? null}}</td>
            <td>{{$data->subhead_code}}</td>
            <td>{{$data->subhead_name}}</td>
            <td>N{{number_format(($data->approved_provision ?? '0'),2)}}</td>
            {{-- <td>{{$data->name ?? null}}</td> --}}
            {{-- <td>{{$data->created_at ?? null}}</td> --}}
            {{-- <td>&#8358;{{ number_format($data->appropriated_amount ? : '0', 2) }}</td> --}}

            <td>

              {{-- <a data-toggle = "tooltip" title = "See Units"   href="javascript:void(0);"><i class="bx bx-grid me-1"></i> </a> &nbsp; --}}
              <a data-toggle = "tooltip" title = "Edit This Department"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal-{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This Department"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>

          <form action="{{ route('subhead.update', [$data->id]) }}" method="PUT" >
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel1">Subhead Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Subhead Code</label>
                        <input type="text" name="subhead_code" id="nameBasic" class="form-control" value="{{$data->subhead_code}}">
                      </div>
                    </div>


                      <div class="row">
                        <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Subhead Name</label>
                          <input type="text"  name="subhead_name" id="nameBasic" class="form-control" value="{{$data->subhead_name}}">
                        </div>
                      </div>

                      {{-- <div class="row">
                        <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Code</label>
                          <input type="text" name="appropirated_amount" id="nameBasic" class="form-control" value="{{$data->code}}">
                        </div>
                      </div> --}}

                      <div class="row">
                        <div class="col mb-3">
                          <label for="nameBasic" class="form-label">Status</label><br/>
    <input type="radio" id="status1" name="status" value="ACTIVE" {{ $data->status == 'ACTIVE' ? 'selected' : '' }}>
  <label for="status1">Active</label><br>
  <input type="radio" id="status2" name="status" value="INACTIVE" {{ $data->status == "INACTIVE" ? 'selected' : '' }}>
  <label for="status2">Inactive</label><br>
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

            @empty
            <tr>
              <td colspan="5" style="color:red">Oops! No Subhead registered yet</td>
            </tr>

            @endforelse

            <tr>
              <td colspan="8">
                {{ $subheads->links('pagination::default') }}
                </td>
            </tr>

        </tbody>
      </table>

   
    </div>
  </div>
</div>
@endsection

@section('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> --}}
<script>
    $(document).ready(function () {
        var dataTable = $('#subheadsTable').DataTable({
            "paging": true,
            "searching": true, // Enable searching
            "ordering": true,
            "info": true,
        });

        // Add global search functionality
        $('#globalSearch').on('keyup', function () {
            dataTable.search(this.value).draw();
        });
    });
</script>
@endsection


