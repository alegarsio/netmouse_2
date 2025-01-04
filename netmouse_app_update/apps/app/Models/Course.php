<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     // Tentukan atribut yang dapat diisi secara massal
     protected $fillable = [
        'title',
        'description',
        'mentor_id',
    ];

    /**
     * Relasi dengan model User sebagai mentor.
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    
    public function students()
{
    return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id');
}


    public function materials()
    {
        return $this->hasMany(Material::class);
    }
    public function users()
{
    return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
}
public function joinedUsers()
{
    return $this->hasMany(JoinedCourse::class, 'course_id');
}
    public function basicQuestions()
    {
        return $this->hasMany(BasicQuestion::class);
    }

}
