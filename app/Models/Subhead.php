<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subhead extends Model
{
    use HasFactory;
    protected $table = 'subhead';
    public $fillable = ['id', 'subhead_code', 'subhead_name', 'status', 'remarks', 'created_by'];
}
