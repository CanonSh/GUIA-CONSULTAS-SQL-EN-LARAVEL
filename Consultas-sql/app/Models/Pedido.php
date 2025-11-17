<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $table = 'pedidos';
    protected $fillable = ['id_usuario', 'producto', 'cantidad', 'total'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

}
