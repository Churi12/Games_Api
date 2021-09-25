<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    protected $fillable = [
        'name'
    ];

    use SoftDeletes;

    protected $hidden = [
        'pivot'
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
