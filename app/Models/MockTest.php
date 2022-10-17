<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_number',
        'obtained_number',
        'test_type',
        'status'

    ];

    public function mockTestItems()
    {
        return $this->hasMany(MockTestItems::class);
    }
}
