<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class attendanceModel extends Model
{
    use HasFactory;

    protected $table = 'tb_attendance';
    protected $fillable = [
        'id',
        'date_attendance',
        'time_attendance',
        'status',
        'courses_id',
        'students_id',
        'create_at',
        'update_at'
    ];

    /**
     * Get the user that owns the attendanceModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function students()
    {
        return $this->belongsTo(studentsModel::class, 'students_id')->withDefault();
    }
    
    public function courses()
    {
        return $this->belongsTo(coursesModel::class, 'courses_id')->withDefault();
    }
    
}
