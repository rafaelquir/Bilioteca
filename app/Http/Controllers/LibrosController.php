<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liga;

class LibrosControllers extends Controller
{
    public function listarTodos ()
    {
        $libros = libro::all(['id','titulo','sinopsis','genero','nombreAutor']);

        return $libros;
    }

    public function unLibro($id)
    {
        $response = array('error_code' => 404, 'error_msg' => 'Liga '.$id.' not found');
        $libros = libro::find($id);
        if(!empty($libros)){
            $response = ['libro' => $libros->nombre, 'partidos' => []];
            $partidos = $libros->partidos;
            foreach ($partidos as $partido) {
                $response['partidos'][] = [
                    'id' => $partido->id,
                    'fecha' => $partido->fecha,
                    'local_id' => $partido->local,
                    'local' => $partido->equipoLocal->nombre,
                    'visitante_id' => $partido->visitante,
                    'visitante' => $partido->equipoVisitante->nombre
                ];
            }
        }
        return response()->json($response);

    }

}


?>
