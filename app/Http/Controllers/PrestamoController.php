<?php

namespace App\Http\Controllers;

use App\libros;
use App\Prestamo;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function makePrestamo(Request $request)
    {

        $respose = ['error'=>404,'message'=>'Libro o usuario no registrado'];

            if(isset($request->user) && !empty($request->user) && isset($request->libro) && !empty($request->libro))
            {

                if(!empty($libro) && !empty($user))
                {
                    $prestamo = new Prestamo();
                    $prestamo->id_book = $request->libro;
                    $prestamo->id_user = $request->user;
                    $prestamo->date_prestamo = date('Y-m-d H:i:s');
                    try
                    {
                        $prestamo->save();
                        $respose = ['error'=>200,'message'=>'Prestamo Realizado correctamente'];
                    }
                    catch(\Exception $e)
                    {
                        $respose = ['error'=>500,'message'=>$e->getMessage()];
                    }
                }
                else
                {
                    $respose = ['error'=>404,'message'=>'Recurso no encontrado'];
                }
            }
            else
            {
                $respose = ['error'=>400,'message'=>'El id del libro es necesaro o es necesario un usuario registrado'];
            }
            return response()->json($respose);
        }

        public function devolPrestamo(Request $request){

            $respose = ['error'=>404,'message'=>'registro del prestamo no encontrado'];
            if(isset($request->id_prestamo) && !empty($request->id_prestamo)){
                $prestamo = Prestamo::find($request->id_prestamo);
                if(is_null($prestamo->date_devol))
                {
                    try
                    {

                        $prestamo->date_devol = date('Y-m-d H:i:s');

                        $prestamo->save();

                        $respose = ['error'=>200,'message'=>'Libro devuelto correctamente'];

                    }
                    catch(\Exception $exception)
                    {
                        $respose = ['error'=>400,'message'=>$exception->getMessage()];
                    }
                }
                else
                {
                    $respose = ['error'=>300,'message'=> 'El libro ya ha sido devuelto'];
                }

            }
            return response()->json($respose);
        }

        public function allPrestamos($user)
        {
            $prestamos = DB::table('prestamos')->where('id_user',$user)->whereNull('date_devol')->get();
            return response()->json($prestamos);
        }

        public function allDevoluciones($user){
            $prestamos = DB::table('prestamos')->where('id_user',$user)->whereNotNull('date_devol')->get(['id','id_libro','']);
            return response()->json($prestamos);
        }

    }
}
