<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "message",
        "user_id",
        "post_id",
        "hidden"
    ];

    public function User(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
