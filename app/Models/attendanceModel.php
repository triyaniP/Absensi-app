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
        'date',
        'time',
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
    public function courses(): BelongsTo
    {
        return $this->belongsTo(coursesModel::class, 'courses_id', 'id');
    }
    public function students(): BelongsTo
    {
        return $this->belongsTo(studentsModel::class, 'students_id', 'id');
    }
}
