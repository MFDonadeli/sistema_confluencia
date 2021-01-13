<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValoresController;

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

Route::get('/', [ValoresController::class, 'index']);
Route::get('/import', [ValoresController::class, 'import']);
Route::get('/start-import/{source}/{dthr}', [ValoresController::class, 'start_import']);
Route::get('/candles-data/{source}/{moeda}', [ValoresController::class, 'candles_data']);
Route::get('/resultado-data/{source}/{moeda}', [ValoresController::class, 'resultado_data']);
Route::get('/processa-estrategia/{source}/{moeda}', [ValoresController::class, 'processa_estrategia']);

/* (1) 
app()->bind('example', function() {
    return new \App\Example();
});*/

Route::get('/test', function (/*App\Example $example*/ /* (2) */) {

    /*Service Container 1 -- This need to implement that Container.php
    $container = new \App\Container();

    $container->bind('example', function () {
        return new \App\Example();
    });

    $example = $container->resolve('example');

    $example->go(); */

    //From here Container.php not needed
    //When it's a string we need that app()->bind (1)
    //$example = resolve('example');
    //$example = resolve(App\Example::class);
    //Without all previous I can pass it through parameter like this one (2)
    //$example->go();

    $exp = "App\Example";
    $example = resolve($exp);
    $example->go();

});

Route::get('/welcome', function () {
    return view('welcome');
});
