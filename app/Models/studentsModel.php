<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentsModel extends Model
{
    use HasFactory;

    protected $table = 'tb_students';
    protected $fillable = [
        'id',
        'NIM',
        'name',
        'email',
        'phone',
        'dapartement',
        'create_at',
        'update_at'
    ];
}
