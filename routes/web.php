<?php

use App\Http\Controllers\QrcodeController;
use App\Livewire\Admin\Form\GarageShow;
use App\Livewire\Admin\Form\PengukuranLila;
use App\Livewire\Admin\Pages\DashboardTps;
use App\Livewire\Admin\Pages\Data\FormGarageShow;
use App\Livewire\Admin\Pages\DataLila\Lila;
use App\Livewire\Admin\Pages\DataSekolah\DataSekolah;
use App\Livewire\Admin\Pages\DataSekolahOrganisasi;
use App\Livewire\Admin\Pages\Permission;
use App\Livewire\Admin\Pages\Role;
use App\Livewire\Admin\Pages\User;
use App\Livewire\Admin\Pages\Home;
use App\Livewire\Admin\Pages\Pendaftaran\Pendaftaran;
use App\Livewire\Admin\Pages\TPS\InputTPS;
use App\Livewire\Admin\Pages\TPS\PendaftaranTPS;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('template', function () {
    return File::get(public_path() . '/documentation.html');
});


Route::get('/', function () {
    return view('auth/login');
});
Route::get('/pengukuran-lila', PengukuranLila::class)->name('pengukuranlila');
Route::get('/qrcode/{id}', [QrcodeController::class, 'index'])->name('qrcode');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::group(['middleware' => 'tps.protect'], function () {
        Route::get('/dashboard-tps', DashboardTps::class)->name('dashboard-tps');
        Route::get('/pendaftaran-tps', PendaftaranTPS::class)->name('pendaftaran-tps');
        Route::get('/tps', InputTPS::class)->name('tps');
        Route::get('/dashboard', Home::class)->name('home');
        Route::get('/datalila', Lila::class)->name('data-lila');
        Route::get('/datagarageshow', FormGarageShow::class)->name('data-garageshow');
        Route::get('/sekolah', DataSekolah::class)->name('sekolah');
        Route::get('/sekolahorganisasi', DataSekolahOrganisasi::class)->name('sekolahorganisasi');
        Route::get('/user', User::class)->name('user');
        Route::get('/role', Role::class)->name('role');
        Route::get('/permission', Permission::class)->name('permission');
        Route::get('/pendaftaran', Pendaftaran::class)->name('pendaftaran');
    });
});
