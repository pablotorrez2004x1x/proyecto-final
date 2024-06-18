<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class productoController extends Controller
{
    //
    public function principal()
    {
        $producto = Producto::withTrashed()->paginate(5);
        return view('productos.principal', ['prod' => $producto]);
    }

    public function crear()
    {
        $categorias=Categoria::all();
        return view('productos.crear', compact('categorias'));
    }

    public function mostrar($variable)
    {
          $producto = Producto::find($variable);

          $cat_id=$producto->categoria_id;
          
          $categoria = Categoria::find($cat_id);



        // return view('productos.mostrar', ['prod'=>$variable]);
        return view("productos.mostrar", compact('producto','categoria'));
    }

    public function store(Request $request)
    {
        $pro=new Producto();
        $pro->nombre=$request->nombre;
        $pro->precio=$request->precio;
        $pro->descripcion=$request->descripcion;
        $pro->categoria=$request->categoria;
        $pro->categoria_id=$request->categoria_id;

        // return $request->all();
        $pro->save();

        // return redirect()->route('producto.principal');
        return redirect()->route('producto.mostrar', $pro->id);

    }
    public function editar(Producto $producto)
    {
    //la variable $categoria_actual llevara la categoriacorrespondiente al producto indicado;
   $cat_id=$producto->categoria_id;
    $categoria_actual=Categoria::find($cat_id);
    //la variable $categorias llevara todos los registros de la tablacategorias
    $categorias=Categoria::all();
    //se enviaran a la vista EDITAR las variables:
    return view("editar",compact('producto','categoria_actual','categorias'));
    }
    


    public function update(Request $request, Producto $producto)
    {
  
        $producto->nombre=$request->nombre;
        $producto->precio=$request->precio;
        $producto->descripcion=$request->descripcion;
        $producto->categoria=$request->categoria;
        $producto->categoria_id=$request->categoria_id;

        // return $request->all();
        $producto->save();
        return redirect()->route('producto.mostrar', $producto->id);
    }
     public function borrar($id){

$producto=Producto::withTrashed()->find($id);
$producto->forceDelete();

return redirect()->route('producto.principal');
     }

     public function desactivaproducto($id){

        $producto=Producto::find($id);
        $producto->delete();
        
        return redirect()->route('producto.principal');
             }
             public function activaproducto($id){

                $producto=Producto::withTrashed()->find($id);
                $producto->restore($id);
                
                return redirect()->route('producto.principal');
                     }
}    

