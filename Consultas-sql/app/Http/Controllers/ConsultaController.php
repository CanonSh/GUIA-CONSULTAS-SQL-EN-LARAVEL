<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class ConsultaController
{
    //
        public function insertar()
    {
        Usuario::insert([
            ['nombre'=>'Ronaldo','correo'=>'ronaldo@mail.com','telefono'=>'7777-0001'],
            ['nombre'=>'Maria','correo'=>'maria@mail.com','telefono'=>'7777-0002'],
            ['nombre'=>'Ricardo','correo'=>'ricardo@mail.com','telefono'=>'7777-0003'],
            ['nombre'=>'Fernanda','correo'=>'fer@mail.com','telefono'=>'7777-0004'],
            ['nombre'=>'Rafa','correo'=>'rafa@mail.com','telefono'=>'7777-0005'],
        ]);

        Pedido::insert([
            ['id_usuario'=>1,'producto'=>'Laptop','cantidad'=>1,'total'=>150.00],
            ['id_usuario'=>2,'producto'=>'Mouse','cantidad'=>2,'total'=>40.00],
            ['id_usuario'=>2,'producto'=>'Teclado','cantidad'=>1,'total'=>120.00],
            ['id_usuario'=>3,'producto'=>'Monitor','cantidad'=>1,'total'=>250.00],
            ['id_usuario'=>5,'producto'=>'USB','cantidad'=>3,'total'=>18.00],
        ]);

        return "Datos insertados correctamente";
    }

    public function pedidosUsuarioId2(){
        $pedidos=Pedido::where('id_usuario',2)->get();
        return $pedidos;
    }

    public function informacionDetalladaPedidoYUsuario(){
        $detallePedido=Pedido::with('usuario')->get();
        return $detallePedido;
    }

    public function pedidos100a250(){
        $pedidos=Pedido::whereBetween('total',[100,250])->get();
        return $pedidos;
    }

    public function usuarioStartR(){
        $usuario=Usuario::where('nombre', 'LIKE', 'R%')->get();
        return $usuario;
    }

    public function totalPedidosUsuario5(){
        $totalPedidos= Pedido::where('id_usuario',5)->count();
        return $totalPedidos;
    }

    //7
    public function PedidosyUsuariosOrdenadosPorTotal(){
        $detallesPedidos= DB::table('pedidos')
        ->join('usuarios','usuarios.id','=','pedidos.id_usuario')
        ->select('pedidos.*','usuarios.*')
        ->orderBy('total','desc')
        ->get();
        return $detallesPedidos;
    }

    //8
    public function sumaTotal(){
        $totalsum=DB::table('pedidos')->sum('total');
        return $totalsum;
    }

    //9
    public function pedidoMenorYNombreUsuario(){
        $detallePedido=DB::table('pedidos')
        ->join('usuarios','usuarios.id','=','pedidos.id_usuario')
        ->select('pedidos.*','usuarios.nombre')
        ->orderBy('total','asc')
        ->first();
        return $detallePedido;
    }

    //10
    public function pedidosAgrupadoPorUsuario(){
        $pedidos=Pedido::with('usuario')
        ->select('id_usuario','producto','cantidad','total')
        ->get()
        ->groupBy('id_usuario');
        
        return $pedidos;
    }
}
