<?php

namespace App\Http\Controllers;

use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    /**
     * guarda un archivo en nuestro directorio local.
     * @param Request $request
     */
    public function save(Request $request)
    {

        //obtenemos el campo file definido en el formulario
        $file = $request->file('file');
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        Storage::disk('local')->put($nombre, $request->file('file'));
        return "archivo guardado";
    }


}
