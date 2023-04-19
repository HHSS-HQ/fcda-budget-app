<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReport extends Model
{
    use HasFactory;
    protected $table = 'project_report';
    public $fillable = ['project_id', 'observations', 'recommendations', 'challenges', 'image_id'];
}
