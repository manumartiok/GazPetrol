<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoFoto extends Model
{
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id');
    }
}
