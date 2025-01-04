<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Material extends Model
{

    protected $table = 'materials_tables';

    protected $fillable = ['title', 'content', 'course_id', 'image_path']; // Tambahkan image_path

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    // Accessor untuk mendapatkan URL gambar
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset($this->image_path); // Sudah benar, menggunakan asset()
        }
        return null;
    }

    public function shortQuestions()
{
    return $this->hasMany(ShortQuestion::class);
}
}
