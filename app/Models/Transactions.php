<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    public $fillable = ['allocation_id', 'transaction_type', 'transaction_amount', 'payee_id', 'narration', 'project_id', 'transaction_date', 'payee_bank', 'payee_account_number', 'updated_by'];
}
