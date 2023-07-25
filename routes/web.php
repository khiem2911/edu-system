<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\EssayController;
use App\Http\Controllers\CertipicateController;

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
//khiem - seminar
Route::get('/seminar', [SeminarController::class, 'loadData'])->name("homeSerminar");
Route::get('/checkDelete',[SeminarController::class, 'deleteSeminar'])->name("deleteSeminar");
Route::post('deleteAll',[SeminarController::class, 'deleteAllSeminar'])->name("deleteAll");
Route::get('EditSer/{id}',[SeminarController::class, 'editSeminar'])->name("editSeminar");
Route::post('updateSer/{id}',[SeminarController::class, 'updateSeminar'])->name("updateSeminar");
Route::get('/search',[SeminarController::class, 'searchSeminar'])->name("searchSerminar");
Route::get('/filter',[SeminarController::class, 'filterSeminar'])->name("filterSerminar");
Route::post('checkAdd',[SeminarController::class, 'addSeminar'])->name("addSeminar");
Route::get('/seminar/sort_seminar',[SeminarController::class, 'sortSeminar'])->name("sortSerminar");

Route::get('/', function() {
    return view('dashboard');
});


//điền
Route::get('/essay', [EssayController::class, 'loadData'])->name("homeEssay");
Route::get('/Delete',[EssayController::class, 'DeleteEssay'])->name("DeleteEssay");
Route::post('deleteAll',[EssayController::class, 'deleteAllEssay'])->name("deleteAll");
Route::get('EditEssay/{id}',[EssayController::class, 'editEssay'])->name("editEssay");
Route::post('updateEssay/{id}',[EssayController::class, 'updateEssay'])->name("updateEssay");
Route::get('filterEssay',[EssayController::class, 'filterEssay'])->name("filterEssay");
Route::get('/searchEssay',[EssayController::class, 'searchEssay'])->name("searchEssay");
Route::get('checkAdd',[EssayController::class, 'addEssay'])->name("addEssay");
Route::get('/essay/sort_essay',[EssayController::class, 'sortEssay'])->name("sortEssay");


//oanh
Route::get('/certipicate', [CertipicateController::class, 'loadData'])->name("homeCertipicate");
Route::get('/DeleteCertipicate',[CertipicateController::class, 'loadData'])->name("DeleteCertipicate");
Route::post('deleteAll',[CertipicateController::class, 'deleteAllCertipicate'])->name("deleteAll");
Route::get('EditCertipicate/{id}',[CertipicateController::class, 'editCertipicate'])->name("editCertipicate");
Route::post('updateCertipicate/{id}',[CertipicateController::class, 'updateCertipicate'])->name("updateCertipicate");
Route::get('filterCertipicate',[CertipicateController::class, 'filterCertipicate'])->name("filterCertipicate");
Route::get('/searchCertipicate',[CertipicateController::class, 'searchCertipicate'])->name("searchCertipicate");
Route::get('checkAdd',[CertipicateController::class, 'addCertipicate'])->name("addCertipicate");
Route::get('/certipicate/sort_certipicate',[CertipicateController::class, 'sortCertipicate'])->name("sortCertipicate");