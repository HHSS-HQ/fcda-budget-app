<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Project Report</title>
<script>
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    border: 1px solid black;
    padding: 8px;
  }

  th {
    background-color: lightgray;
  }
  </script>
</head>
<body>
  {{-- <img src="{{asset('assets/img/FCT-logo.png')}}" /> --}}
  @foreach ($projects as $item)
  <center><img src="FCT-logo.png" style="width:17%;" /></center>
  <p style="text-align: center; font-size:26px; font-weight:bolder; margin-top:0em; margin-bottom:0em;">FEDERAL CAPITAL TERRITORY ADMINISTRATION</p>
  <p style="text-align: center; font-size:20px; margin-top:0em; margin-bottom:0em; text-transform: uppercase;">{{$item->department_name}} DEPARTMENT</p>
  <p style="text-align: center; font-size:22px; margin-top:0em; margin-bottom:0em;"><u>PROJECT REPORT</u></p>

  <p style="text-align: left; font-size:18px; margin-top:0em; margin-bottom:0em;"><u>PROJECT INFORMATION</u></p>



  <table>

    {{-- <tr>
      <td style="width:20%">Project Type: </td>
      <td>{{$item->project_type ?? null}} </td>
    </tr> --}}

    <tr>
      <td style="width:20%">Project Title: </td>
      <td>{{$item->project_title ?? null}}</td>
    </tr>

    <tr>
      <td style="width:20%">Project Location: </td>
      <td>{{$item->project_location ?? null}}</td>
    </tr>

    <tr>
      <td style="width:20%">Payee Name: </td>
      <td>{{$item->payee_name ?? null}}</td>
    </tr>

    <tr>
      <td style="width:20%">Date of Award: </td>
      <td>{{$item->date_of_award ?? null}}</td>
    </tr>

    <tr>
      <td style="width:20%">Appropriation: </td>
      <td>N{{number_format(($item->appropriation ?? 0),2)}}</td>
    </tr>

    <tr>
      <td style="width:20%">Contract Sum: </td>
      <td>N{{number_format(($item->contract_sum ?? 0),2)}}</td>
    </tr>

    <tr>
      <td style="width:25%">Commencement Date: </td>
      <td>{{$item->commencement_date ?? null}}</td>
    </tr>

    <tr>
      <td style="width:25%">Completion Period: </td>
      <td>{{$item->completion_period ?? null}}</td>
    </tr>

    @php
    $project_id = $item->project_id;
    $contract_sum = $item->contract_sum;
      // $contract_sum = App\Models\Project::select('project.contract_sum')->where('project_id', '=', $project_id)->first();
      $amount_paid = App\Models\Fundproject::selectRaw('SUM(amount) as total_amount')->where('project_id', '=', $project_id)->first();
      $total_amount_paid = $amount_paid ? $amount_paid->total_amount : 0;

      $percentage_payment_made = ($total_amount_paid / $contract_sum) * 100;

      @endphp
      <tr>
        <td style="width:25%">Percentage Payment Made: </td>
        <td>{{$percentage_payment_made ?? 0}}%</td>
      </tr>

      {{-- <tr>
        <td style="width:25%">Percentage Complete: </td>
        <td>{{$percentage_complete ?? 0}}%</td>
      </tr> --}}

    <tr>
      <td style="width:25%">Amount Paid Till Date: </td>
      <td>N{{number_format(($total_amount_paid ?? 0), 2)}}</td>
    </tr>

    <tr>
      <td style="width:25%">Outstanding Balance: </td>
      <td>N{{number_format(($contract_sum-$total_amount_paid ?? 0), 2)}}</td>
    </tr>

    <tr>
      <td style="width:25%">Certified CV Not Paid: </td>
      <td>{{$certified_cv_not_paid ?? null}}</td>
    </tr>

    {{-- <tr>
      <td style="width:25%">Year Last Funded: </td>
      <td>{{$item->certified_cv_not_paid ?? null}}</td>
    </tr>
    @php
    $date = \Carbon\Carbon::parse($item->last_funded_date, 'UTC')->setTimezone('Africa/Lagos');
    $last_funded_date = $date->isoFormat('Do MMMM, YYYY');
  @endphp --}}
    {{-- <tr>
      <td style="width:25%">Last Funded Date: </td>
      <td>{{$last_funded_date ?? null}}</td>
    </tr> --}}

</table>
<br/>
<p style="text-align: left; font-size:18px; margin-top:0em; margin-bottom:0em;"><u>PROJECT FUNDING HISTORY</u></p>
<table width="100%" border="1px" style="border-collapse:collapse">
  @php
    $funding_history = App\Models\Fundproject::select('project_funding.*', 'budget.budget_year', 'accounting_year.*', 'project.*', 'project_funding.created_at as funding_date')
    ->join('project', 'project.id', '=', 'project_funding.project_id')
    ->join('budget', 'budget.id', '=', 'project_funding.budget_id')
    ->join('accounting_year', 'accounting_year.id', '=', 'budget.budget_year')
    ->where('project_funding.project_id', '=', $project_id)->get();
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
    ->join('project', 'project.id', '=', 'project_report.project_id')
    // ->join('budget', 'budget.id', '=', 'project_funding.budget_id')
    // ->join('accounting_year', 'accounting_year.id', '=', 'budget.budget_year')
    ->where('project_report.project_id', '=', $project_id)->get();
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


@endforeach
</body>
</html>



