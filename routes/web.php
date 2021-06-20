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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',['uses'=>'ModulesController@manageModules']);
Route::post('add-module',['as'=>'add.module','uses'=>'ModulesController@addModule']);
Route::post('add-testCase',['as'=>'add.testCase','uses'=>'ModulesController@addTestcase']);
Route::get('task-view',['uses'=>'ModulesController@manageTask'])->name('task.view');
//Route::get('task-delete',['uses'=>'destroy@destroy'])->name('task.view');
Route::get('task-delete/{id}', 'ModulesController@destroy');