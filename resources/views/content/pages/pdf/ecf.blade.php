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
  @foreach ($ecfs as $item)
  <center><img src="/FCT-logo.png" style="width:17%;" /></center>
  <p style="text-align: center; font-size:26px; font-weight:bolder; margin-top:0em; margin-bottom:0em;">FEDERAL CAPITAL TERRITORY ADMINISTRATION</p>
  <p style="text-align: center; font-size:24px; margin-top:0em; margin-bottom:0em; text-transform:uppercase;">{{$item['department']['department_name'] ?? null}} department</p>
  <p style="text-align: center; font-size:22px; margin-top:0em; margin-bottom:0em;"><u>RECURRENT EXPENDITURE CONTROL FORM</u></p>

  <p style="text-align: left; font-size:20px; margin-top:0em; margin-bottom:0em;"><u>BUDGETARY PROVISION</u></p>
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
      <td style="text-align:right"><h3>ECF #: {{$item['id'] ?? null}}</h3></td>
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
    <td><h5>Capture Date:</h5> <h3 class="text-uppercase">{{$uploaded_date ?? null}}</h3></td>
    
    <td><h5>Subhead Code:</h5> <h3 class="text-uppercase">{{$item['subhead']['subhead_code'] ?? null}}</h3></td>
    
    <td colspan="2"><h5>Subhead Name:</h5> <h3 class="text-uppercase">{{$item['subhead']['subhead_name'] ?? null}}</h3></td>
    
  </tr>
   
    
    <tr>
      <td><h5>Payee Name:</h5> <h3 class="text-uppercase">{{$item['payee']['payee_name'] ?? null}}</h3></td>
          <td><h5>Phone Number:</h5> <h3 class="text-lowercase">{{$item['payee']['payee_phone'] ?? null}}</h3></td>
          <td><h5>Alternate Number:</h5> <h3 class="text-uppercase">{{$item['payee']['payee_phone2'] ?? null}}</h3></td>
          <td colspan="1"><h5>Email:</h5> <h3 class="text-uppercase">{{$item['payee']['payee_email'] ?? null}}</h3></td>
          
    </tr>



          <tr >
          <td colspan="4"><ul><h4><br/>REQUISITION DETAILS</h4></ul></td>
          </tr>
          <tr >
          <td style="color:red" ><h5>Present Requisition:</h5> <h3 class="text-uppercase">N{{number_format(($item['present_requisition'] ?? null),2)}}</h3></td>
          <td style="color:red" colspan="3"> <h5>Epxenditure Item:</h5> <h3 class="text-uppercase">{{$item['expenditure_item'] ?? null}}</h3></td>
          {{-- <td style="color:red"> <h5>Time:</h5> <h3 class="text-uppercase"></h3></td> --}}
      
         
          </tr>
          
          </table>
  </div>
  <div>

  <div class="invoice-info">
      
      <p class="text-muted">
     <b>NB:</b> As at the date of printing this ECF, the following infomation were captured:</p>
      <table>
        <tr>
          <td><b>Approved Provision: </b></td>
          <td><b>N{{number_format(($item['approved_provision'] ?? null),2)}}</b></td>
        </tr>

        <tr>
          <td><b>Revised Provision:</b></td>
          <td><b>N{{number_format(($item['revised_provision'] ?? null),2)}}</b></td>
        </tr>

        <tr>
          <td><b>Expenditure till date: </b></td>
          <td><b>N0.00</b></td>
        </tr>

        <tr>
          <td><b>Current balance:  </b></td>
          <td><b>N{{number_format(($department_budget->budgetary_allocation-$department_budget->budget_utilization), 2)}}</b></td>
        </tr>

        <tr>
          <td><b>Balance Carried Forward: </b></td>
          <td><b>N{{number_format(($department_budget->budgetary_allocation-$department_budget->budget_utilization), 2)}}</b></td>
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
      
      
  </div>
</div>

</div>
</div>
@endforeach
</body>
</html>



