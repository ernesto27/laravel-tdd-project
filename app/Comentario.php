<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = ['texto', 'producto_id', 'user_id', 'parent_comment_id'];
}
