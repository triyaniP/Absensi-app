<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coursesModel extends Model
{
    use HasFactory;

    protected $table = 'tb_courses';
    protected $fillable = [
        'id',
        'course_code',
        'course_name',
        'lecturer_name',
        'semester',
        'create_at',
        'update_at'
    ];
}
