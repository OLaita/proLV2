<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentView extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user',
        'idVideo',
        'created_at'
    ];
}
