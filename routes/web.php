<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('formulario', 'StorageController@index');
Route::get('senae/indese', 'StorageController@indese')->name('senae.indese');
Route::get('senae/forma', 'StorageController@forma')->name('senae.forma');
Route::post('senae/reporte/{repote}', 'StorageController@reporte')->name('senae.reporte');
Route::post('storage/create', 'StorageController@save')->name('storage.create');
Route::get('testtt', function () {
    //$contents = Storage::get('hola[4058].txt')->store('public');
    $d = new \App\Http\Controllers\ArchivoController();
    $d->filldos('storage/chao[4053].txt');
})->name('test');
Route::get('storage/{archivo}', function ($archivo) {
    $public_path = public_path();
    $url = $public_path.'/storage/'.$archivo;
    //verificamos si el archivo existe y lo retornamos
    if (\Illuminate\Support\Facades\Storage::exists($archivo))
    {
        return response()->download($url);
    }
    //si no se encuentra lanzamos un error 404.
    abort(404);

})->name('storage.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
