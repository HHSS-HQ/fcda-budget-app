<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImages extends Model
{
    use HasFactory;
    protected $table = 'project_images';
    public $fillable = ['project_id', 'image_name', 'image_location'];
}
