<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{

    /**
     * muestra el formulario para guardar archivos
     *
     * @return Response
     */
    public function index()
    {
        return view('site.formulario.new');
    }
}
