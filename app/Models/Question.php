<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
      'text',
      'type',
      'text_url',
      'number_answers',
      'mark_distribution',
    ];

    public function answers(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Answer');
    }
}
