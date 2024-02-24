<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubheadAllocation extends Model
{
    use HasFactory;
    protected $table = 'subhead_allocation';
    public $fillable = ['allocation_id', 'subhead_id', 'department_id', 'year_id', 'year_appropriated_sum', 'year_adjusted_sum',  'approved_provision', 'revised_provision', 'status', 'remarks', 'created_by'];

    public function subhead()
    {
        return $this->belongsTo(Subhead::class, 'subhead_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
