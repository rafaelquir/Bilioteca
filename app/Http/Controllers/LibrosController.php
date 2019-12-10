<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\libros;

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
        $libreria = libros::all()->where('nombreAutor',$autor);
        if(!empty($libreria)){
            $response = $libreria;
        }
        return response()->json($response);
    }

    public function mostrarPorGenero($genero)
    {
        $response = Array('codigo_error' =>404, 'message'=>'No se encuentra un libro por este genero' .$genero);
        $libreria =  libros::all()->where('genero', $genero);
    }

}


?>
