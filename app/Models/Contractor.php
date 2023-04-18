<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;
    protected $table = 'contractor';
    public $fillable = ['company_name', 'contractor_name', 'contractor_account_number', 'contractor_account_name', 'contractor_bank', 'contractor_phone_number'];
}
