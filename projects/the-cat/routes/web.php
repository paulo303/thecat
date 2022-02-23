<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Psr7\Request;

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
    return redirect()->route('breeds');
})->middleware('auth');;

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/breeds/', [App\Http\Controllers\BreedController::class, 'index'])->name('breeds');

Route::get('/teste', function () {
    // $request = new Request('GET', 'http://dummy.restapiexample.com/api/v1/employees');
    // $response = Http::get('https://api.thecatapi.com/v1/breeds');
    $response = Http::get('http://dummy.restapiexample.com/api/v1/employees');
    // dd($response->json());
    // dd($response->array());
    // dd($response->getBody());
    $body = $response->body();
    $body = json_decode($body);

    dd($body);
});
