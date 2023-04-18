<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';
    public $fillable = ['id', 'department_name', 'created_by', 'remarks'];

    // public function department(): BelongsTo
    // {
    //     return $this->belongsTo(ECF::class, 'department_id', 'id');
    // }

}
