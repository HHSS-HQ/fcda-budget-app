@extends('layouts/contentNavbarLayout')

@section('title', 'Projects')

@section('content')
<a href="/add-project" ><button type="button" class="btn btn-primary" style="float: right">[+] New Project</button></a>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Projects /</span> All Projects
</h4>



<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">All Projects</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">

      <table class="table table-bordered">
        @php $i=1; @endphp
        <thead>
          <tr>
            <th>Project ID</th>
            <th>Project Title</th>
            <th>Contractor Name</th>
            <th>Contract Sum</th>
            <th>Amount Paid</th>
            <th>Oustanding Balance</th>
            <th>% Complete</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($comm as $data)

          @php
          // $amount_paid = App\Models\Fundproject::select('amount', 'id')->where('department_id', '=', $data->id)->first();
          $amount_paid = App\Models\Fundproject::selectRaw('SUM(amount) as total_paid')->where('project_id', $data->project_id)->first();
          @endphp
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->project_title}}</td>
            <td>{{$data->payee_name}}</td>
            <td>&#8358;{{ number_format($data->contract_sum ? : '0', 2) }}</td>
            <td>&#8358;{{ number_format($amount_paid->total_paid ? : '0', 2) }}</td>
            
             <td>&#8358;{{ number_format((($data->contract_sum ? : '0') - ($amount_paid->total_paid ? : '0')), 2) }}</td>
            @php
             $contract_sum = $data->contract_sum;
             $total_amount_paid = $amount_paid->total_paid;
            @endphp

             @if(isset($total_amount_paid) && isset($contract_sum))
             @php
                 $contract_sum = $data->contract_sum ?? 0;
                 $total_amount_paid = $amount_paid->total_paid ?? 0;
         
                 // Calculate the percentage of budget utilization
                 $percentage_paid = ($total_amount_paid / $contract_sum) * 100;
             @endphp
         
             <td>
              <div class="progress mb-3">
                <div class="progress-bar" role="progressbar" style="width: {{ $percentage_paid }}%;" aria-valuenow="{{ $percentage_paid }}" aria-valuemin="0" aria-valuemax="100">{{ $percentage_paid }}%</div>
              </div>
              {{-- {{ number_format($percentage_paid) }}% --}}
            </td>
         @else
             <td>N/A</td>
         @endif
           
             {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
            <td>
              <a data-toggle = "tooltip" title = "Fund This Project"  href="javascript:void(0);"><i class="bx bx-money me-1"></i> </a> &nbsp;
              {{-- <a data-toggle = "tooltip" title = "View This Project"  href="/view_project/{{$data->project_id}}"><i class="bx bx-search-alt-2 me-1"></i> </a> &nbsp; --}}
              <a data-toggle="tooltip" title="Print Project Report" target="_blank" href="/print-project-report?project_id={{$data->project_id}}"><i class="bx bx-printer me-1"></i></a>&nbsp;
              <a data-toggle = "tooltip" title = "Edit This Project"   href="/edit-project/{{$data->project_id}}"><i class="bx bx-edit-alt me-1"></i> </a> &nbsp;
              <a data-toggle = "tooltip" title = "Delete This Project"   href="javascript:void(0);"><i class="bx bx-trash me-1"></i> </a>
            </td>
          </tr>
          @empty
                <tr>
                  <td colspan="6" style="color:red">Oops! No projects registered yet</td>
                </tr>

          @endforelse


        </tbody>
      </table>
    </div>
  </div>
</div>
<!--/ Bordered Table -->

@section('scripts')
<script>
    $(document).ready(function () {
        $('.table').DataTable();
    });
</script>
@endsection

<!--/ Responsive Table -->
@endsection
