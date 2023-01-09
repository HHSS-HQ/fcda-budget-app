<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $table = 'budget';
    public $fillable = ['id', 'budget_year', 'appropraited_amount', 'code', 'remarks', 'created_by'];
}
