<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\libros;
class ApiLibroController extends Controller
{
    public function index()
    {
        return libros::all();
    }
}
