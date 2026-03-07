<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'media';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'file_path',
        'file_type',
        'post_id',
        'user_id',
    ];

    // Define relationships if needed
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
