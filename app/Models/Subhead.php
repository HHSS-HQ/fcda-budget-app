<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subhead extends Model
{
    use HasFactory;
    protected $table = 'subhead';
    public $fillable = ['id', 'subhead_code', 'approved_provision', 'subhead_name', 'department_id', 'status', 'remarks', 'created_by'];
}
