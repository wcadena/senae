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
    public function store($storegroup, $campana,$grupoanuncio,Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:191',
            'descripcion'         => 'required|max:191',
            'alt'     => 'required|max:191',
            'image_url'     => 'required|image',
            'activa'     => 'required'
        ]);
        $requestData = $request->all();
        $requestData['grupoanuncio_id'] = $grupoanuncio;
        $requestData['clicks'] = 0;
        $requestData['views_ajax'] = 0;
        //image
        $file = $request->file('image_url');
        // Generate a file name with extension
        $fileName = 'banner-'.time().'.'.$file->getClientOriginalExtension();
        // Save the file
        $path = $file->storeAs($storegroup . '-'. $campana . '-' . $grupoanuncio, $fileName,['disk' => 'banner']);
        // ini image 625
        $img = Image::make($request->file('image_url'));
        // prevent possible upsizing
        $img->resize(null, 625, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        Storage::disk('banner')->put('625/'.$storegroup . '-'. $campana . '-' . $grupoanuncio.'/'.$fileName, $img->encode());
        $img->resize(null, 430, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        Storage::disk('banner')->put('430/'.$storegroup . '-'. $campana . '-' . $grupoanuncio.'/'.$fileName, $img->encode());
        $img->resize(null, 137, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        Storage::disk('banner')->put('137/'.$storegroup . '-'. $campana . '-' . $grupoanuncio.'/'.$fileName, $img->encode());
        $img->resize(null, 100, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        Storage::disk('banner')->put('100/'.$storegroup . '-'. $campana . '-' . $grupoanuncio.'/'.$fileName, $img->encode());
        $img->resize(null, 80, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        Storage::disk('banner')->put('80/'.$storegroup . '-'. $campana . '-' . $grupoanuncio.'/'.$fileName, $img->encode());
        // fin image 625
        $requestData['image_path'] = $path;
        $requestData['image_url'] = Storage::url('banner/'.$storegroup . '-'. $campana . '-' . $grupoanuncio.'/'.$fileName);
        //image
        Anuncio::create($requestData);
        return redirect()->route('grupoanuncio.show', ['country' => $storegroup,'campana' => $campana,'grupoanuncio' => $grupoanuncio])->with('flash_message', 'Anuncio Creado');
    }

}
