<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    protected $fillable = ['follower_id', 'followed_id'];

    // If you want to use timestamps for your pivot table
    public $timestamps = true;
}


