<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingYear extends Model
{
    use HasFactory;
    protected $table = 'accounting_year';
    public $fillable = ['accounting_year', 'status', 'comment', 'added_by'];
}
