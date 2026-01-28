<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'description',
        'year',
        'is_available'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}