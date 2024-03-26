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
            <th>Oustanding Balance</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($comm as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->project_title}}</td>
            <td>{{$data->payee_name}}</td>
            <td>&#8358;{{ number_format($data->contract_sum ? : '0', 2) }}</td>
            <td>&#8358;{{ number_format($data->outstanding_balance ? : '0', 2) }}</td>
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
