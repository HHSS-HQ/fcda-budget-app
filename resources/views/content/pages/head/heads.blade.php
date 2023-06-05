@extends('layouts/contentNavbarLayout')

@section('title', 'Heads')

@section('content')
<a href="/add-head" ><button type="button" class="btn btn-primary" style="float: right">[+] New Head</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Heads /</span> All Heads
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Heads</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">

      <table class="table table-bordered">
        @php $i=1; @endphp
        <thead>
          <tr>
            <th>SN</th>
            <th>Head Code</th>
            <th>Head Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($heads as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->head_code}}</td>
            <td>{{$data->head_name ?? null}}</td>
            {{-- <td>{{$data->department_name ?? 'No unit assigned'}}</td> --}}

            <td>

              {{-- <a data-toggle = "tooltip" title = "See Units"   href="javascript:void(0);"><i class="bx bx-grid me-1"></i> </a> &nbsp; --}}
              <a data-toggle = "tooltip" title = "Edit This Department"   href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal-{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This Department"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>

          <form action="{{ route('head.update', [$data->id]) }}" method="PUT" >
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel1">Head Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Head Code</label>
                        <input type="text" name="head_code" id="nameBasic" class="form-control" value="{{$data->head_code}}">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Head Name</label>
                        <input type="text" name="head_name" id="nameBasic" class="form-control" value="{{$data->head_name}}">
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
                  <td colspan="5" style="color:red">Oops! No heads registered yet</td>
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
