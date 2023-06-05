<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h3>All Departments</h3>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Department Name</th>
                <th>Department Code</th>
                <th>Budget Allocation</th>
                <th>Budget Utilization</th>
                <th>Utilization %</th>
                <th>Budget Balance</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sn = 1;
            @endphp
            @foreach($departments as $data)
            @php
            $active_budget = App\Models\DepartmentBudget::select('budgetary_allocation')->where('department_id', '=', $data->id)->first();
            $budget_utilization = App\Models\ECF::selectRaw('SUM(present_requisition) as total')->where('department_id', $data->id)->where('budget_id', $data->budget_id)->first();
            @endphp
                <tr>
                    <td>{{ $sn++ }}</td>
                    <td>{{$data->department_name}}</td>
                    <td>{{$data->department_code ?? null}}</td>
                    <td>N{{number_format(($active_budget->budgetary_allocation ?? null),2)}}</td>
                    <td>N{{number_format(($budget_utilization->total ?? null),2)}}</td>
                    <td>N{{number_format(($active_budget->budgetary_allocation-$budget_utilization->total),2)}}</td>
                    <td>{{number_format((($budget_utilization->total/$active_budget->budgetary_allocation )*100),2)}}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
