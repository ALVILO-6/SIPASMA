<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Tampilkan halaman utama
Route::get('/advo',[App\Http\Controllers\AdvoController::class, 'index']);

//Tampilkan halaman form aspirasi
Route::get('/form', function() {
    return view('Form');
});

// //Tampilkan halaman aspirasi yang sudah diselesaikan
// Route::get('/done', function() {
//     return view('Done');
// })->middleware('role:Ketua Komisi Advokasi, Sekretaris Komisi Advokasi');

//Tampilkan halaman utama, dengan menampilkan juga data-data fungsio dari AdvoController
Route::get('/struktur',[App\Http\Controllers\AdvoController::class, 'getStruktur']);

//Kirimkan data aspirasi yang di post ke database
Route::post('/proses-aspirasi',[App\Http\Controllers\AdvoController::class, 'postAspirasi']);

//Validasi NIM
Route::post('/validate-nim',[App\Http\Controllers\AdvoController::class, 'validateNIM'])->name('validateNIM');

//Generate tracking code sebelum submit aspirasi
Route::post('/generate-tracking',[App\Http\Controllers\AdvoController::class, 'generateTracking']);

//Track aspirasi dengan kode pelacakan
Route::post('/track-aspirasi',[App\Http\Controllers\AdvoController::class, 'trackAspirasi']);

//Login
Route::get('/login', function() {
    return view('Login');
});

//Validasi NIM
Route::post('/check-nim',[App\Http\Controllers\AuthController::class, 'checkNIM'])->name('check-nim');

//Validasi NIM dan Password
Route::post('/validate-user',[App\Http\Controllers\AuthController::class, 'validateUser'])->name('validate-user');

//Halaman admin utama
Route::get('/dashboard',[App\Http\Controllers\AdminController::class, 'dashboards'])->name('dashboard');

//Logout
Route::post('/logout',[App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

//Ambil panggilan untuk ditampilkan di Dashboard
Route::post('/get-panggilan',[App\Http\Controllers\AdminController::class, 'getPJ'])->name('get-panggilan');

//Delete aspirasi
Route::post('/delete/{id}',[App\Http\Controllers\AdminController::class, 'deletePJ'])->name('deletePJ');

//Update aspirasi
Route::post('/update/{id}',[App\Http\Controllers\AdminController::class, 'updatePJ'])->name('updatePJ');

//Ambil nama PJ
Route::post('/nim-pj',[App\Http\Controllers\AdminController::class, 'nimPJ'])->name('nimPJ');

//Update status
Route::post('/updateS/{id}',[App\Http\Controllers\AdminController::class, 'updateStatus'])->name('updateStatus');

//Simpan tanggapan
Route::post('/tanggapan/{id}',[App\Http\Controllers\AdminController::class, 'updateTanggapan'])->name('updateTanggapan');

// //Search aspirasi
// Route::post('/aspirasi-search',[App\Http\Controllers\AdminController::class, 'searchAspirasi'])->name('searchAspirasi');

//Tampilkan FAQ
Route::get('/faq',[App\Http\Controllers\AdvoController::class, 'getFAQ']);

//Dapatkan data Kategori
Route::post('/get-kategori',[App\Http\Controllers\AdvoController::class, 'getKategori'])->name('get-kategori');

//Dapatkan data kategori di dropdown form aspirasi
Route::get('/form',[App\Http\Controllers\AdvoController::class, 'listKategori']);

//Ambil semua data aspirasi yang sudah dikerjakan
Route::get('/done',[App\Http\Controllers\AdminController::class, 'aspirasiDone'])
    ->middleware('role:Ketua Komisi Advokasi,Sekretaris Komisi Advokasi');

Route::post('/forget-password',[App\Http\Controllers\AuthController::class, 'forgetPassword'])->name('forgetPassword');

Route::post('/check-limit',[App\Http\Controllers\AdvoController::class, 'aspirasiLimit'])->name('checkLimit');

Route::get('/pie-chart',[App\Http\Controllers\AdminController::class, 'pieChart'])->name('pieChart');

Route::get('/line-graph',[App\Http\Controllers\AdminController::class, 'lineGraph'])->name('lineGraph');

Route::post('/validate-token',[App\Http\Controllers\AuthController::class, 'validateToken'])->name('validateToken');

Route::post('/reset-password',[App\Http\Controllers\AuthController::class, 'resetPassword'])->name('resetPassword');