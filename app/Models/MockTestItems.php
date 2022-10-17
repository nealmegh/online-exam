<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockTestItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'type',
        'text_url',
        'number_answers',
        'mark_distribution',
        'question_id',
        'mock_test_id',
        'answer_text',
        'correct_answer',
        'user_answer',
        'number',
        'category_id',
        'isPro',
        'isCorrect',
        'explanation',

    ];
    public function mockTest()
    {
        return $this->belongsTo(mockTest::class, 'mock_test_id');
    }
}
