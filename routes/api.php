<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AgendaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('Test', [ApiController::class,'Test']);
Route::post('Login', [ApiController::class,'Login']);
Route::post('HapusAgenda', [ApiController::class,'HapusAgenda']);
Route::post('InsertPermohonanAgendaOPD', [ApiController::class,'InsertPermohonanAgendaOPD']);
Route::post('InsertAgendaAjudan', [ApiController::class,'InsertAgendaAjudan']);
Route::post('KonfirmasiAgenda', [ApiController::class,'KonfirmasiAgenda']);
Route::post('UpdateAgenda', [ApiController::class,'UpdateAgenda']);
Route::post('DashboardPegawai', [ApiController::class,'DashboardPegawai']);
Route::post('DashboardAjudan', [ApiController::class,'DashboardAjudan']);
Route::post('GetAgendaByPegawai', [ApiController::class,'GetAgendaByPegawai']);
Route::post('GetAgendaAjudan', [ApiController::class,'GetCatatanBulanan']);
Route::post('GetFilterAgendaByPegawai', [ApiController::class,'GetFilterAgendaByPegawai']);
Route::post('GetFilterAjudan', [ApiController::class,'GetFilterAjudan']);
Route::post('GetAgendaForAjudan', [ApiController::class,'GetAgendaForAjudan']);
Route::post('GetAgendaPerwakilanForAjudan', [ApiController::class,'GetAgendaPerwakilanForAjudan']);
Route::post('GetAgendaBupati', [ApiController::class,'GetAgendaBupati']);
Route::post('GetAgendaKonfirmasiBupati', [ApiController::class,'GetAgendaKonfirmasiBupati']);
Route::post('GetFilterAgendaAjudan', [ApiController::class,'GetFilterAgendaAjudan']);
Route::post('PrintAgenda', [ApiController::class,'PrintAgenda']);
Route::post('GetSurat', [ApiController::class,'GetSurat']);
Route::post('GetSingleAgenda', [ApiController::class,'GetSingleAgenda']);
Route::post('GetCatatanBulanan', [ApiController::class,'GetCatatanBulanan']);
Route::post('GetPendamping', [ApiController::class,'GetPendamping']);

// Route::post('UpdateSandi', [ApiController::class,'UpdateSandi']);
// Route::post('CreateUser', [ApiController::class,'InsertUser']);
// Route::post('CreateAgenda', [ApiController::class,'InsertAgenda']);
// Route::post('UpdateAgenda', [ApiController::class,'UpdateAgenda']);
// Route::post('HapusAgenda', [ApiController::class,'HapusAgenda']);
// Route::post('GetAgendaAtasan', [ApiController::class,'GetAgendaAtasan']);
// Route::post('GetAllAgendaAtasan', [ApiController::class,'GetAllAgendaAtasan']);
// Route::post('GetAgendaBawahan', [ApiController::class,'GetAgendaBawahan']);
// Route::post('GetInbox', [ApiController::class,'GetInbox']);
// Route::post('GetTotalInbox', [ApiController::class,'GetTotalInbox']);
// Route::post('UpdateStatusInbox', [ApiController::class,'UpdateStatusInbox']);
// Route::post('UpdateFirbaseToken', [ApiController::class,'UpdateFirebaseToken']);
// Route::post('SendNotification', [ApiController::class,'SendNotification']);
// Route::post('GetTokenById', [ApiController::class,'GetTokenById']);
// Route::post('UpdateStatusKehadiran', [ApiController::class,'UpdateStatusKehadiran']);

Route::get('TestSiswa', [ApiController::class,'TestSiswa']);
Route::post('GetSiswaByNisn', [ApiController::class,'GetSiswaByNisn']);
Route::post('GetUserById', [ApiController::class,'GetUserById']);
Route::post('Register', [ApiController::class,'Register']);
Route::post('LoginSiswa', [ApiController::class,'LoginSiswa']);
Route::post('CreateAgendaSiswa', [ApiController::class,'CreateAgendaSiswa']);
Route::post('UpdateAgendaSiswa', [ApiController::class,'UpdateAgendaSiswa']);
Route::post('GetAgenda', [ApiController::class,'GetAgenda']);
Route::post('AbsenPulang', [ApiController::class,'AbsenPulang']);
Route::post('AbsenMasuk', [ApiController::class,'AbsenMasuk']);
Route::post('GetAbsensi', [ApiController::class,'GetAbsensi']);
Route::post('CekAbsen', [ApiController::class,'CekAbsen']);
