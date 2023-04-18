<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payee extends Model
{
    use HasFactory;
    protected $table = 'payee';
    public $fillable = ['payee_name', 'payee_account_number', 'payee_bank', 'payee_phone_number'];

}
