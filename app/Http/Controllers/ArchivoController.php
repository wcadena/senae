<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Repouno;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function show(Archivo $archivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Archivo $archivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archivo $archivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archivo $archivo)
    {
        //
    }

    public function lectura(String $archivo)
    {
        //$contents = Storage::get('hola[4058].txt')->store('public');
        $vf = \File::get($archivo);
        $primpos = strpos($vf, '|', 2);
        $segupos = strpos($vf, '[]', 2);
        $extract = substr($vf,$primpos,$segupos-$primpos);
        //dd($primpos,$segupos,$extract,$vf);
        return $extract;
    }
    public function filluno(String $archivo){
        $archiv = $this->lectura($archivo);
        $lineas = explode(PHP_EOL, $archiv);
        $pos = 0;
        $ultim = count($lineas);
        //dd($lineas,$ultim);
        foreach ($lineas as $linea){
            $pos++;
            if($pos > 1 && $pos < $ultim){
                $palabra = explode('|', $linea);
                $rep1 = new Repouno();
                $rep1->row =        $this->clean($palabra[1]);
                $rep1->customer =   $this->clean($palabra[2]);
                $rep1->seat =       $this->clean($palabra[3]);
                $rep1->accept =     $this->clean($palabra[4]);
                $rep1->regulatoryinformation = $this->clean($palabra[5]);
                $rep1->save();
            }
        }

    }
    public function filldos(String $archivo){
        $archiv = $this->lectura($archivo);
        $lineas = explode(PHP_EOL, $archiv);
        $pos = 0;
        $ultim = count($lineas);
        //dd($lineas,$ultim);
        for($i = 0; $i < $ultim; ++$i) {
            $linea = $lineas[$i];
            $pos++;
            if($pos > 1 && $pos < $ultim && $pos%2 === 0 ){
                $palabra = explode('|', $linea);
                /*
                $rep1 = new Repouno();
                $rep1->row =        $this->clean($palabra[1]);
                $rep1->customer =   $this->clean($palabra[2]);
                $rep1->seat =       $this->clean($palabra[3]);
                $rep1->accept =     $this->clean($palabra[4]);
                $rep1->regulatoryinformation = $this->clean($palabra[5]);
                $rep1->save();
                */
                dd($lineas[$i+1]);
            }
        }

    }
    public function clean($valor){
        return trim(utf8_encode($valor));
    }
}
