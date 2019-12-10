<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\libros;

class LibrosControllers extends Controller
{
    public function listarTodos ()
    {
        return libros::all();
    }

}


?>
