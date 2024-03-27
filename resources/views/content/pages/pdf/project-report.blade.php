<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Project Form</title>
</head>
<body>
  {{-- <img src="{{asset('assets/img/FCT-logo.png')}}" /> --}}
  @foreach ($projects as $item)
  <center><img src="/FCT-logo.png" style="width:17%;" /></center>
  <p style="text-align: center; font-size:26px; font-weight:bolder; margin-top:0em; margin-bottom:0em;">FEDERAL CAPITAL TERRITORY ADMINISTRATION</p>
  <p style="text-align: center; font-size:24px; margin-top:0em; margin-bottom:0em; text-transform:uppercase;">{{$item->department_name ?? null}} department</p>
  <p style="text-align: center; font-size:22px; margin-top:0em; margin-bottom:0em;"><u>PROJECT REPORT FORM</u></p>

  <p style="text-align: left; font-size:18px; margin-top:0em; margin-bottom:0em;"><u>PROJECT INFORMATION</u></p>
{{-- @php
  $i="a";
@endphp --}}
<?php
  $department_budget = App\Models\DepartmentBudget::select('budgetary_allocation', 'budget_utilization')->first();

  ?>

  {{-- <ul type="i"> --}}
    





<div class="row">
  <div class="col-sm-6 col-lg-6 m-b-20">
  <table width="100%" style="border-collapse:collapse">
      <tr>
      <td style="text-align:right"><h5>PROJECT #: {{$item->project_id ?? null}}/________________</h5></td>
      </tr>
      </table>
<table width="100%" border="1" style="border-collapse:collapse">
  @php
  $date = \Carbon\Carbon::parse($item->uploaded_date, 'UTC')->setTimezone('Africa/Lagos');
  $uploaded_date = $date->isoFormat('Do MMMM, YYYY');
@endphp
  
{{-- <tr>
  <td colspan="4"><h5>Department:</h5> <h3 class="text-uppercase">{{$item['department']['department_name'] ?? null}}</h3></td>
</tr> --}}

<tr>
    <td><h5>Date of Award:</h5> <h3 class="text-uppercase">{{$item->date_of_award ?? null}}</h3></td>
    
    <td><h5>File Number:</h5> <h3 class="text-uppercase">{{$item->file_number ?? null}}</h3></td>
    
    <td colspan="3"><h5>Project Title:</h5> <h3 class="text-uppercase">{{$item->project_title ?? null}}</h3></td>
    
  </tr>
   
    
    <tr>
          <td><h5>Payee Name:</h5> <h3 class="text-uppercase">{{$item->payee_name ?? null}}</h3></td>
          <td><h5>Phone Number:</h5> <h3 class="text-lowercase">{{$item->payee_phone ?? null}}</h3></td>
          <td><h5>Alternate Number:</h5> <h3 class="text-uppercase">{{$item->payee_phone2 ?? null}}</h3></td>
          <td colspan="2"><h5>Email:</h5> <h3 class="text-uppercase">{{$item->payee_email ?? null}}</h3></td>
          
    </tr>

    @php
    $amount_paid = App\Models\Fundproject::selectRaw('SUM(amount) as total_paid')->where('project_id', $item->project_id)->first();
    @endphp
    @php
    $contract_sum = $item->contract_sum;
    $total_amount_paid = $amount_paid->total_paid;
    @endphp
   
          <tr>
          <td colspan="5"><ul><h4><br/>PROJECT DETAILS</h4></ul></td>
          </tr>
          <tr>
            <td><h5>Commencement Date:</h5> <h3 class="text-uppercase">{{ $item->project_location ?? null}}</h3></td>
            <td><h5>Project Title:</h5> <h3 class="text-lowercase">{{ $item->project_title ?? null }}</h3></td>
            <td><h5>RC Number:</h5> <h3 class="text-uppercase">{{$company_RC_number ?? null}}</h3></td>
            <td><h5>Completion Period:</h5> <h3 class="text-uppercase">{{$item->completion_period ?? null}}</h3></td>
            <td><h5>Last Funded Date:</h5> <h3 class="text-uppercase">{{$item->last_funded_date ?? null}}</h3></td>
            </tr>




            <tr>
              <td colspan="5"><ul><h4><br/>PAYMENT DETAILS</h4></ul></td>
              </tr>
              <tr>
                <td><h5>Appropriation:</h5> <h3 class="text-uppercase">N{{number_format(($item->appropriation?? null),2)}}</h3></td>
                <td><h5>Contract Sum:</h5> <h3 class="text-lowercase">N{{number_format(($item->contract_sum ?? null),2)}}</h3></td>
                <td><h5>Amount Paid:</h5> <h3 class="text-uppercase">N{{number_format(($total_amount_paid ?? null),2)}}</h3></td>
                @php
                $contract_sum = $item->contract_sum ?? 0;
                $total_amount_paid = $amount_paid->total_paid ?? 0;
                @endphp
                <td><h5>Balance:</h5> <h3 class="text-uppercase">N{{number_format(($contract_sum - $total_amount_paid),2)}}</h3></td>
                @if(isset($total_amount_paid) && isset($contract_sum))
                <td colspan="1"><h5>% Complete:</h5> <h3 class="text-uppercase">{{number_format(($total_amount_paid / $contract_sum)*100)}}%</h3></td>
                @else
                <h3>N/A</h3>
                @endif
    
                </tr>
          
          </table>


        </table>
        <br/>
        <p style="text-align: left; font-size:18px; margin-top:0em; margin-bottom:0em;"><u>PROJECT FUNDING HISTORY</u></p>
        <table width="100%" border="1px" style="border-collapse:collapse">
          @php
            $funding_history = App\Models\Fundproject::select('project_funding.*', 'budget.budget_year', 'accounting_year.*', 'project.*', 'project_funding.created_at as funding_date')
            ->join('project', 'project.project_id', '=', 'project_funding.project_id')
            ->join('budget', 'budget.id', '=', 'project_funding.budget_id')
            ->join('accounting_year', 'accounting_year.id', '=', 'budget.budget_year')
            ->where('project_funding.project_id', '=', $item->project_id)->get();
          @endphp
          <th>Date</th>
          <th>Project Title</th>
          <th>Budget Year</th>
          <th>Amount Funded</th>
        
          @foreach ($funding_history as $project_list)
          @php
            $date = \Carbon\Carbon::parse($project_list->funding_date, 'UTC')->setTimezone('Africa/Lagos');
            $formatted_date = $date->isoFormat('Do MMMM, YYYY');
          @endphp
        
            <tr>
              <td>{{ $formatted_date}}</td>
              <td>{{$project_list->project_title}}</td>
              <td>{{$project_list->accounting_year_name}} ({{ Carbon\Carbon::createFromFormat('Y-m', $project_list->start_date)->format('F, Y') }} - {{ Carbon\Carbon::createFromFormat('Y-m', $project_list->end_date)->format('F, Y') }})</td>
              <td>N{{number_format(($project_list->amount),2)}}</td>
            </tr>
        
          @endforeach
        </table>

        {{-- Project Report --}}
<br/>
<p style="text-align: left; font-size:18px; margin-top:0em; margin-bottom:0em;"><u>PROJECT MONITORING REPORT</u></p>
<table width="100%" border="1px" style="border-collapse:collapse">
  @php
    $project_report = App\Models\ProjectReport::select('project_report.*', 'project.project_title')
    ->join('project', 'project.project_id', '=', 'project_report.project_id')
    // ->join('budget', 'budget.id', '=', 'project_funding.budget_id')
    // ->join('accounting_year', 'accounting_year.id', '=', 'budget.budget_year')
    ->where('project_report.project_id', '=', $item->project_id)->get();
  @endphp
  <th>Visit Date</th>
  <th>Project Title</th>
  <th>Observations</th>
  <th>Challenges</th>
  <th>Recommendations</th>

  @foreach ($project_report as $report_list)
  @php
    $date = \Carbon\Carbon::parse($report_list->created_at, 'UTC')->setTimezone('Africa/Lagos');
    $formatted_date = $date->isoFormat('Do MMMM, YYYY');
  @endphp

    <tr>
      <td>{{ $formatted_date}}</td>
      <td>{{$report_list->project_title}}</td>
      <td>{{$report_list->observations}}</td>
      <td>{{$report_list->challenges}}</td>
      <td>{{$report_list->recommendations}}</td>
    </tr>

  @endforeach
</table>

  </div>
  <div>


</div>

</div>
</div>
@endforeach
</body>
</html>



