<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentBudget extends Model
{
    use HasFactory;

    protected $table = 'department_budget';
    public $fillable = ['id', 'parent_budget_id', 'department_id', 'created_by', 'remarks', 'budgetary_allocation', 'budget_utilization'];

    // public function department(): BelongsTo
    // {
    //     return $this->belongsTo(ECF::class, 'department_id', 'id');
    // }

}
