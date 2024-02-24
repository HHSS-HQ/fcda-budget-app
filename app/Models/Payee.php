<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payee extends Model
{
    use HasFactory;
    protected $table = 'payee_new';
    // public $fillable = ['payee_name', 'payee_account_number', 'payee_bank', 'payee_phone_number'];
    public $fillable = ['payee_type', 'payee_name', 'payee_account_number', 'payee_bank', 'payee_phone', 'payee_phone2', 'payee_sortcode', 'payee_email', 'remarks'];

}
