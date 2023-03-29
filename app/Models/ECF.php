<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ECF extends Model
{
    use HasFactory;
    protected $table = 'ecf';
    public $fillable = ['id', 'subhead_id', 'department_id', 'head_id', 'expenditure_item', 'payee_id', 'approved_provision', 'revised_provision', 'status', 'checked_by', 'prepared_by'];


    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
        // return $this->hasOne(Department::class, 'department_id');
        return $this->hasOne(Department::class);
    }



    public function subhead(): HasOne
    {
        return $this->HasOne(Subhead::class, 'id', 'subhead_id');
    }


    public function payee(): HasOne
    {
        return $this->HasOne(User::class, 'id', 'payee_id');
    }
}


