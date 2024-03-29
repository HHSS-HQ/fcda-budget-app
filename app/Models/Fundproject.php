<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundproject extends Model
{
    use HasFactory;
    protected $table = 'project_funding';
    public $fillable = ['project_id', 'amount', 'comment'];



    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
