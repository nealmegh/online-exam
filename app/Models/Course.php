<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = [
        'title',
        'amount',
        'status',
        'stripe_plan'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
