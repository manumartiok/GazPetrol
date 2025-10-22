<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'usuario',
        'email',
        'contraseña',
        'rol',
        'active',
    ];

    protected $hidden = [
        'contraseña',
    ];

    // Laravel espera 'password' por defecto, indicamos que es 'contraseña'
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}