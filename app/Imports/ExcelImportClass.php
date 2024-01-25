<?php
// app/Imports/ExcelImportClass.php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Subhead;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExcelImportClass implements ToModel, WithStartRow
{
    private $headId, $departmentId;

    public function __construct($headId, $departmentId)
    {
        $this->headId = $headId;
        $this->departmentId = $departmentId;
    }

    public function model(array $row)
    {
        // Define how to create a model from the Excel row data
        return new Subhead([
            'head_id' => $this->headId,
            'department_id' => $this->departmentId,
            'subhead_code' => $row[0],
            'subhead_name' => $row[1],
            'approved_provision' => $row[2],
            'remarks' => $row[3],
            'status' => $row[4],
            // 'department_id' => $row[2],
            // Add more columns as needed
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
