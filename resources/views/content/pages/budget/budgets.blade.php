@extends('layouts/contentNavbarLayout')

@section('title', 'Budgets')

@section('content')
<a href="/add-budget"><button type="button" class="btn btn-primary" style="float: right">[+] New Budget</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Budget /</span> All Budgets
</h4>

<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Budgets</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
@php $i=1; @endphp
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Budget ID</th>
            <th>Budget Year</th>
            <th>Appropriated Amount</th>
            <th>Amount Utilized </th>
            <th>Balance</th>
            <th>Code </th>
            <th>Status </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($budgets as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->accounting_year_name}} ({{ Carbon\Carbon::createFromFormat('Y-m', $data->start_date)->format('F, Y') }}-{{ Carbon\Carbon::createFromFormat('Y-m', $data->end_date)->format('F, Y') }})</td>
            <td style="color:green">&#8358;{{ number_format($data->appropriated_amount ? : '0', 2) }}</td>
            <td>&#8358;{{ number_format($data->total_funding ? : '0', 2) }}</td>
            <td style="color:red">&#8358;{{ number_format($data->appropriated_amount-$data->total_funding ? : '0', 2) }}</td>
            <td>{{$data->code}}</td>
            {{-- <td>{{$data->status}}</td> --}}
            @if ($data->budget_status == "INACTIVE")
            <td style="color:red;">{{$data->budget_status}}</td>
            @else
            <td style="color:green;">{{$data->budget_status}}</td>
            @endif
            @if ($data->budget_status == "INACTIVE")
            <td>
              <form id="update-budget-form" action="/update-budget-status" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $data->budget_id }}">
                <button type="submit" class="btn btn-outline-secondary" data-bs-dismiss="modal">Make Active</button>
              </form>

              <script>
                document.getElementById('update-budget-form').addEventListener('submit', function(event) {
                  var confirmed = confirm('Are you sure you want to make this budget active?');
                  if (!confirmed) {
                    event.preventDefault();
                  }
                });
              </script>

            </td>
            @else
            <td>
              <i class="bx bx-check" style="font-size: 30px; color:green"></i>
              {{-- <img src="{{asset('assets/img/illustrations/tick.jpeg')}}" style="width:20%;" /> --}}
              {{-- <a data-toggle="tooltip" title="Print ECF" target="_blank" href="/print-ecf?id={{$data->id}}"><i
                  class="bx bx-printer me-1"></i></a>&nbsp;
              <a data-toggle="tooltip" title="Edit This ECF" href="javascript:void(0);" data-bs-toggle="modal"
                data-bs-target="#basicModal-{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle="tooltip" title="Delete This ECF" href="javascript:void(0);"><i
                  class="bx bx-trash me-1"></i> </a> --}}
            </td>
            @endif
          </tr>

          <form action="{{ route('budget.update', [$data->id]) }}" method="PUT">
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel1">Budget Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Budget Year</label>
                        <input type="number" min="2022" max="2040" name="budget_year" id="nameBasic"
                          class="form-control" value="{{$data->budget_year}}">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Appropriated Amount</label>
                        <input type="number" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+"
                          name="appropriated_amount" id="nameBasic" class="form-control"
                          value="{{$data->appropriated_amount}}">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Code</label>
                        <input type="text" name="appropirated_amount" id="nameBasic" class="form-control"
                          value="{{$data->code}}">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Status</label><br />
                        <input type="radio" id="status1" name="status" value="ACTIVE"
                          {{ $data->status == 'ACTIVE' ? 'selected' : '' }}>
                        <label for="status1">Active</label><br>
                        <input type="radio" id="status2" name="status" value="INACTIVE"
                          {{ $data->status == "INACTIVE" ? 'selected' : '' }}>
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
            <td colspan="5" style="color:red">Oops! No budgets registered yet</td>
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
