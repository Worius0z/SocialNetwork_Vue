<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'like',
        'dislike',
        'likeable_id',
        'likeable_type',
    ];

    public function likeable() {
        return $this->morphTo();
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
