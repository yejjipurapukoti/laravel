<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;

    // ✅ Table name (if not following Laravel convention)
    protected $table = 'course_student';

    // ✅ Fillable fields
    protected $fillable = [
        'student_id',
        'course_id',
    ];

    // ✅ Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
