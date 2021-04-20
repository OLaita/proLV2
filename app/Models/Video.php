<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cont',
        'desc',
        'mini',
        'user',
        'puntos',
        'visitas'
    ];

    public function users()
    {
        return $this
            ->belongsToMany('App\Models\User')
            ->withPivot('user_id');
    }
}
