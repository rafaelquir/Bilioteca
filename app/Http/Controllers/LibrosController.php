<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\libros;
use PhpParser\Node\Expr\Empty_;

class LibrosControllers extends Controller
{
    public function listarTodos ()
    {
        $libreria = libros::all();
        return response()->json($libreria);
    }

    public function motrarPorAutor ($autor)
    {
        $response = Array('codigo_error' =>404, 'message'=>'No de encuentra el libro por el autor'.$autor);
        $libreria = libros::table()->where('nombreAutor',$autor);
        if(!empty($libreria)){
            $response = $libreria;
        }
        return response()->json($response);
    }

    public function mostrarPorGenero($genero)
    {
        $response = Array('codigo_error' =>404, 'message'=>'No se encuentra un libro por este genero' .$genero);
        $libreria =  libros::all()->where('genero', $genero);
        if(!empty($libreria)){

            $response = $libreria;

        }

        return response()->json($response);

    }

    public function createLibro(Request $request)
    {
        $response = array('codigo_error'=>400,'message'=>'Error al crear el libro');
        $libro = new libros();
        if(!empty($request)){

            try
            {
                $libro->titulo =$request->titulo;
                $libro->sinposis = $request->sinposis;
                $libro->genero = $request->genero;
                if(isset($request->autor) && !empty($request->autor)){
                    $libro->autor = $request->autor;
                }
                else
                {
                    $libro->autor = 'Desconocido';
                }
                $libro->save();
                $response = array('codigo_error'=>200,'message'=>'Success');
            }
            catch (\Exception $exception)
            {
                $response = array('codigo_error'=>500,'message'=>$exception->getMessage());
            }
        }
        else
        {
            $response = array('codigo_error'=>400,'message'=>'Todos los campos son obligatorios');
        }
        return response()->json($response);

    }

    public function editLibro(Request $request, $id)
    {
        $response = array('codigo_error'=>400,'message'=>'El libro no se ha encontrado');
        $libro = libros::find($id);
        $check = true;
        if(!empty($libro))
        {
            if(isset($request->titulo))
            {
                    if(!Empty($request->titulo))
                    {

                    }
            }
        }
    }
    public function dropBook($id){

        $response = array('codigo_error'=>400,'message'=>'libro no encontrado');
        $libro = libros::find($id);
        if(!empty($book)){
            try{
                $libro->delete();
                $response = array('codigo_error'=>200,'message'=>'Book drop success');
            }catch(\Exception $exception){
                $response =  $response = array('codigo_error'=>400,'message'=>$exception->getMessage());
            }
        }
        return response()->json($response);
    }

}


?>
