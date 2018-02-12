<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $guarded = [];


    public function scopeByCategoria($query, $categoria)
    {
        return $query->where('categoria_id', $categoria);
    }
}
