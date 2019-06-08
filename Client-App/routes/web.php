<?php

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

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Getting data from resource app
Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://localhost:8000/callback', // Client app
        'response_type' => 'code',
        'scope' => '*',
    ]);

    return redirect('http://localhost:8080/oauth/authorize?'.$query); // Resource app
})->name('redirect');

//Route::get('/callback', function (Request $request) {
////    $http = new GuzzleHttp\Client;
////
////    $response = $http->post('http://localhost:8080/oauth/token', [
////        'form_params' => [
////            'grant_type' => 'authorization_code',
////            'client_id' => '3',
////            'client_secret' => 'fgr33eyE61Opfs3M436sR8ElA5laHmPu3DTazJDq',
////            'redirect_uri' => 'http://localhost:8000/callback',
////            'code' => $request->code,
////        ],
////    ]);
////
////    return json_decode((string) $response->getBody(), true);
//
//    var_dump($request->access_token);
//});

Route::get('/callback', 'API\LoginController@handleProviderCallback');
