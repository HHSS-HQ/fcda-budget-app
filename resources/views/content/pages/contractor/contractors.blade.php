@extends('layouts/contentNavbarLayout')

@section('title', 'Contractors')

@section('content')
<a href="/add-contractor"><button type="button" class="btn btn-primary" style="float: right">[+] New Contractor</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Contractor /</span> All Contractors
</h4>

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Payees</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      @php $i=1; @endphp
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Payee ID</th>
            <th>Company Name</th>
            <th>Contractor Name</th>
            <th>Account Number</th>
            <th>Account Name</th>
            <th>Bank </th>
            <th>Phone Number </th>
            <th>Alternate Phone Number </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($contractor as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->company_name ?? null}}</td>
            <td>{{$data->contractor_name ?? null}}</td>
            <td>{{$data->contractor_account_number ?? null}}</td>
            <td>{{$data->contractor_account_name ?? null}}</td>
            <td>{{$data->contractor_bank ?? null}}</td>
            <td>{{$data->contractor_phone_number ?? null}}</td>
            <td>{{$data->alternate_phone_number ?? null}}</td>
            <td></td>

          </tr>

          <form action="{{ route('payee.update', [$data->id]) }}" method="PUT">
            <div class="modal fade" id="basicModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel1">Contractor Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Company Name</label>
                        <input type="text" name="payee_name" id="nameBasic" class="form-control"
                          value="{{$data->company_name}}">
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
            <td colspan="8" style="color:red">Oops! No Payee created yet</td>
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
