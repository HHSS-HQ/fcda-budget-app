@extends('layouts/contentNavbarLayout')

@section('title', 'Project Summary')

@section('content')
<a href="/projects" ><button type="button" class="btn btn-primary" style="float: right">←Back To Projects</button></a>
@foreach ($users as $item)
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">{{$item->project_title}} - </span> {{$item->project_id}}
</h4>



<!-- Bordered Table -->
<div class="col-xxl-8">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">



    </div>
    <div class="card-body"><h4 style="text-align: right; color:blue;">PID: {{$item->project_id}}</h4>
      {{-- <img src="images/fcta-logo.png"/> --}}
      <img src="{{asset('storage/images/fcta-logo.png')}}" alt="" style=" width:15%; display: block; margin-left: auto; margin-right: auto;" />
<h1 style="text-align: center;">OpenBudgetNG</h1>
<h3 style="text-align: center;"><u>Project Information</u></h3>
    </div>
    <div class="card-body">

<table class="table table-bordered" >
<tr>
  <td style="width: 30%; font-size:20px">Project ID:</td>
  <td style="font-size:20px">{{$item->project_id}}</td>
</tr>

<tr>
  <td style="width: 30%; font-size:20px">Project Title:</td>
  <td style="font-size:20px">{{$item->project_title}}</td>
</tr>

<tr>
  <td style="width: 30%; font-size:20px">Project Location:</td>
  <td style="font-size:20px">{{$item->project_location}}</td>
</tr>

<tr>
  <td style="width: 30%; font-size:20px">Contractor Name:</td>
  <td style="font-size:20px">{{$item->contractor_name}}</td>
</tr>

<tr>
  <td style="width: 30%; font-size:20px">Date of Award:</td>
  <td style="font-size:20px">{{$item->date_of_award}}</td>
</tr>

<tr>
  <td style="width: 30%; font-size:20px">Appropriation:</td>
  <td style="font-size:20px">&#8358;{{ number_format($item->appropriation ? : '0', 2) }}</td>
</tr>

<tr>
  <td style="width: 30%; font-size:20px">Contract Sum:</td>
  <td style="font-size:20px">&#8358;{{ number_format($item->contract_sum ? : '0', 2) }}</td>
</tr>

</table>
    </div>
  </div>
</div>

<!--/ Bordered Table -->

@endforeach
<!--/ Responsive Table -->
@endsection
