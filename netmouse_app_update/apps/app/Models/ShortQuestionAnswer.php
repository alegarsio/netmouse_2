<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['short_question_id', 'user_id', 'answer'];

    public function shortQuestion()
    {
        return $this->belongsTo(ShortQuestion::class);
    }

    // Relationship ini diubah, HANYA untuk memastikan user_id diisi
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}