<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntuaciones extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_id',
        'user',
        'voto'
    ];
}
