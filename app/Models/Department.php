<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';
    public $fillable = ['id', 'department_name', 'department_code', 'created_by', 'remarks', 'department_code'];

    // public function department(): BelongsTo
    // {
    //     return $this->belongsTo(ECF::class, 'department_id', 'id');
    // }

}
