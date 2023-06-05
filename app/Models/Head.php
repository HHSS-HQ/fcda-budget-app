<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    use HasFactory;

    protected $table = 'head';
    public $fillable = ['id', 'head_code', 'head_name', 'created_by'];
}
