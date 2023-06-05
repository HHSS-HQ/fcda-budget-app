@extends('layouts/contentNavbarLayout')

@section('title', 'Departments')

@section('content')
<a href="/departments" ><button type="button" class="btn btn-primary" style="float: right">←Back To Departments</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Departments /</span> Budget Utilization
</h4>

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">Budget Utilization</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">

      {{-- {{App\Models\ECF::selectRaw('SUM(ecf.present_requisition) as budget_expenditure')->pluck('budget_expenditure')}} --}}
      @php
      $total_expenditure = App\Models\ECF::selectRaw('SUM(ecf.present_requisition) as budget_expenditure')
          ->where('department_id', '=', request()->input('id'))
          ->first();
  @endphp
  <h4>Total Expenditure: N{{ number_format($total_expenditure->budget_expenditure), 2 }}</h4>


      <table class="table table-bordered">
        @php $i=1; @endphp
        <thead>
          <tr>
            <th>ECF ID</th>
            <th>Department Name</th>
            <th>Head </th>
            <th>Subhead Name</th>
            <th>Description</th>
            <th>Present Requisition</th>
            <th>Payee </th>
            <th>Status </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($budget_utilization as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->department->dept_name ?? null}}</td>
            <td>{{$data->department->department_code ?? null}}-{{$data->subhead->id ?? null}}</td>
            <td>{{$data->subhead->subhead_name ?? null}}</td>
            <td>{{$data->expenditure_item ?? null}}</td>
            <td>&#8358;N{{number_format(($data->present_requisition ?? null),2)}}</td>
            <td>{{$data->payee->payee_name ?? null}}</td>
            @if ($data->status == "PENDING APPROVAL")
            <td style="color:red;">{{$data->status}}</td>
            @else
            <td style="color:green;">{{$data->status}}</td>
            @endif
            @if ($data->status == "PENDING APPROVAL")
            <td>
              <form action="/change-ecf-status" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <button type="submit" class="btn btn-outline-secondary" data-bs-dismiss="modal">APPROVE</button>
              </form>
            </td>
            @else
            <td>
              <a data-toggle="tooltip" title="Print ECF" target="_blank" href="/print-ecf?id={{$data->id}}"><i class="bx bx-printer me-1"></i></a>&nbsp;
              <a data-toggle="tooltip" title="Edit This ECF" href="javascript:void(0);" data-bs-toggle="modal"
                data-bs-target="#basicModal-{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle="tooltip" title="Delete This ECF" href="javascript:void(0);"><i
                  class="bx bx-trash me-1"></i> </a>
            </td>
            @endif

          </tr>

          <form action="{{ route('department.update', [$data->id]) }}" method="PUT">
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel1">ECF Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Department</label>
                        <input type="text" name="department_id" id="nameBasic" class="form-control"
                          value="{{$data->department->dept_name ?? null}}">
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
            <td colspan="5" style="color:red">Oops! No Budget utilization has been recorded for this department yet</td>
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
