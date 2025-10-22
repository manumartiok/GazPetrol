<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
       // Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id')->orderBy('orden');
    }
}
