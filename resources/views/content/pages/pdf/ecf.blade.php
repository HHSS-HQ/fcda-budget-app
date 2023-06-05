<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ECF Form</title>
</head>
<body>
  {{-- <img src="{{asset('assets/img/FCT-logo.png')}}" /> --}}
  <center><img src="https://budget.littlefingers.ng/FCT-logo.png" style="width:17%;" /></center>
  <p style="text-align: center; font-size:26px; font-weight:bolder; margin-top:0em; margin-bottom:0em;">FEDERAL CAPITAL TERRITORY ADMINISTRATION</p>
  <p style="text-align: center; font-size:20px; margin-top:0em; margin-bottom:0em;">PHARMACY DEPARTMENT</p>
  <p style="text-align: center; font-size:22px; margin-top:0em; margin-bottom:0em;"><u>RECURRENT EXPENDITURE CONTROL FORM</u></p>

  <p style="text-align: left; font-size:20px; margin-top:0em; margin-bottom:0em;"><u>BUDGETARY PROVISION</u></p>
@php
  $i="a";
@endphp
  @foreach ($ecfs as $item)
<?php
  $department_budget = App\Models\DepartmentBudget::select('budgetary_allocation', 'budget_utilization')->first();

  ?>
<br/>
  {{-- <ul type="i"> --}}
    <table border="1" style="border-collapse: collapse; align:left;" width="100%">
      @php
      $date = \Carbon\Carbon::parse($item->uploaded_date, 'UTC')->setTimezone('Africa/Lagos');
      $uploaded_date = $date->isoFormat('Do MMMM, YYYY');
    @endphp
      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Date Captured:</td>
        <td>{{$uploaded_date ?? null}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Department:</td>
        <td>{{$item['department']['dept_name'] ?? null}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td width="30%">Head and Subhead:</td>
        <td width="65%">{{$item['head']['head_code'] ??  null}}/{{$item['subhead']['subhead_code'] ?? null}} - {{$item['head']['head_name'] ??  null}}/{{$item['subhead']['subhead_name'] ?? null}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Item of Expenditure (Description):</td>
        <td>{{$item->expenditure_item ?? null}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Payee:</td>
        <td>{{$item['payee']['payee_name'] ?? null}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Approved Provision:</td>
        <td>N{{number_format(($department_budget->budgetary_allocation ?? null),2)}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Revised Provision:</td>
        <td>N{{number_format(($item->revised_provision ?? '0'), 2)}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Expenditure Till Date:</td>
        <td>{{$item->expenditure_item ?? null}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Current Balance: </td>
        <td>N{{number_format(($department_budget->budgetary_allocation-$department_budget->budget_utilization), 2)}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Present Requisition:</td>
        <td>N{{number_format(($item->present_requisition ?? null), 2)}}</td>
      </tr>

      <tr>
        <td>@php echo $i++    @endphp</td>
        <td>Balance Carried Forward:</td>
        <td>N{{number_format(($department_budget->budgetary_allocation-$department_budget->budget_utilization), 2)}}</td>
      </tr>
    </table>


<table width="100%" >

  <tr>
    <td colspan="4"><br/><br/></td>
  </tr>

  <tr>
    <td style="width:15%">Prepared by: </td>
    <td style=" border-bottom: 2px dotted #000; text-decoration: none;"></td>
    <td style="width:15%">Checked by: </td>
    <td style=" border-bottom: 2px dotted #000; text-decoration: none;"></td>
  </tr>

  <tr>
    <td></td>
    <td style="text-align: center;">{{$item['ecf_prepared_by']['ecf_prepared_by'] ?? null}}</td>
    <td></td>
    <td style="text-align: center;">{{$item['ecf_checked_by']['ecf_checked_by'] ?? null}}</td>
  </tr>

  <tr>
    <td colspan="4"><br/><br/></td>
  </tr>
  <tr>
    <td style="text-align:center" colspan="4">Vote Controller .........................</td>
  </tr>
</table>
@endforeach
</body>
</html>



