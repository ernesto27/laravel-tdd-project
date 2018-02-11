<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;

    public function scopeActive($query)
    {
        return $this->where('activo', 1);
    }
}
