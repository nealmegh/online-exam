<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'text',
        'question_id',
        'correct_answer',
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
