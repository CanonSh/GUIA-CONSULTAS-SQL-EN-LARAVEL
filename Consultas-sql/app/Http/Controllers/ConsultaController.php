<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class ConsultaController
{
    //1
    //Insertar datos de prueba en las tablas usuarios y pedidos
    //utilizando el método insert de Eloquent, de especifica el nombre de la columna y el valor a insertar
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
    //2
    //Obtener todos los pedidos del usuario con id 2
    //realizando una consulta con Eloquent utilizando el método where
    //se especifica la columna, el operador y el valor a comparar
    public function pedidosUsuarioId2(){
        $pedidos=Pedido::where('id_usuario',2)->get();
        return $pedidos;
    }

    //3
    //Obtener información detallada de los pedidos junto con la información del usuario que realizó cada pedido
    //utilizando la relación definida en el modelo Pedido con el método with
    public function informacionDetalladaPedidoYUsuario(){
        $detallePedido=Pedido::with('usuario')->get();
        return $detallePedido;
    }

    //4
    //Obtener pedidos con total entre 100 y 250
    //utilizando el método whereBetween de Eloquent, que permite especificar un rango de valores para una columna en un rango [valor1, valor2]
    public function pedidos100a250(){
        $pedidos=Pedido::whereBetween('total',[100,250])->get();
        return $pedidos;
    }

    //5
    //Obtener usuarios cuyo nombre comienza con la letra 'R'
    //utilizando el método where con el operador LIKE para realizar una búsqueda por patrón
    public function usuarioStartR(){
        $usuario=Usuario::where('nombre', 'LIKE', 'R%')->get();
        return $usuario;
    }

    //6
    //Obtener el total de pedidos realizados por el usuario con id 5
    //utilizando el método count de Eloquent para contar el número de registros que cumplen con la condición
    //count devuelve un valor entero con el número de registros
    public function totalPedidosUsuario5(){
        $totalPedidos= Pedido::where('id_usuario',5)->count();
        return $totalPedidos;
    }

    //7
    //Obtener pedidos junto con la información del usuario que realizó cada pedido, ordenados por el total de forma descendente
    //utilizando el query builder de Laravel con join para combinar las tablas pedidos y usuarios
    //se seleccionan todas las columnas de ambas tablas y se ordena por la columna total en orden descendente
    public function PedidosyUsuariosOrdenadosPorTotal(){
        $detallesPedidos= DB::table('pedidos')
        ->join('usuarios','usuarios.id','=','pedidos.id_usuario')
        ->select('pedidos.*','usuarios.*')
        ->orderBy('total','desc')
        ->get();
        return $detallesPedidos;
    }

    //8
    //Obtener la suma total de todos los pedidos
    //utilizando el método sum de Eloquent para sumar los valores de una columna específica
    public function sumaTotal(){
        $totalsum=DB::table('pedidos')->sum('total');
        return $totalsum;
    }

    //9
    //Obtener el pedido con el total menor junto con el nombre del usuario que realizó ese pedido
    //utilizando el query builder de Laravel con join para combinar las tablas pedidos y usuarios
    //se seleccionan todas las columnas de pedidos y la columna nombre de usuarios
    //se ordena por la columna total en orden ascendente y se obtiene el primer resultado
    public function pedidoMenorYNombreUsuario(){
        $detallePedido=DB::table('pedidos')
        ->join('usuarios','usuarios.id','=','pedidos.id_usuario')
        ->select('pedidos.*','usuarios.nombre')
        ->orderBy('total','asc')
        ->first();
        return $detallePedido;
    }

    //10
    //Obtener los pedidos agrupados por usuario
    //utilizando el método groupBy de Eloquent para agrupar los resultados por una columna
    //se obtiene la informacion de las columnas id_usuario, producto, cantidad y total
    public function pedidosAgrupadoPorUsuario(){
        $pedidos=Pedido::with('usuario')
        ->select('id_usuario','producto','cantidad','total')
        ->get()
        ->groupBy('id_usuario');
        
        return $pedidos;
    }
}
