<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
       // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

        public function fotos()
    {
        return $this->hasMany(ProductoFoto::class, 'productos_id','id')->orderBy('orden');
    }
}
