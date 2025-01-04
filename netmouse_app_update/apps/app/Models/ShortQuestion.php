<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'material_id'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    public function answers()
{
    return $this->hasMany(ShortQuestionAnswer::class);
}
}
