<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Medicamentos\MedicamentosController;
use App\Http\Controllers\Medicamentos\MedicamentosEntradaController;
use App\Http\Controllers\Medicamentos\MedicamentosSaidaaController;
use App\Http\Controllers\Medicamentos\MedicamentosUpdateController;
use App\Http\Controllers\Medicamentos\RelatoriosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){

    Route::get('/', UserController::class)->name('index');

    Route::get('/login', function(){
        if (auth()->guest()) {
            return redirect(route('index'))->with(['message' => 'Realize o login para continuar!']);
        }
    });

    Route::post('/login', LoginController::class)->name('login');

});

Route::middleware('auth')->group(function(){

    /** GET METHODS */

    Route::get('/logout', LogoutController::class)->name('logout');

    Route::get('/listagem', [DashboardController::class, 'index'])->name('listagem');

    Route::get('/incluir', [MedicamentosController::class, 'index'])->name('incluir');

    Route::get('/entrada', [MedicamentosEntradaController::class, 'index'])->name('medicamento.entrada');

    Route::get('/saida', [MedicamentosSaidaaController::class, 'index'])->name('medicamento.saida');

    Route::get('/relatorio', [RelatoriosController::class, 'index'])->name('relatorio');

    Route::get('/relatorio/imprimir', [RelatoriosController::class, 'gerarRelatorio'])->name('relatorio.imprimir');

    /** POST METHODS */
    
    Route::post('/incluir', [MedicamentosController::class, 'store']);

    Route::post('/alterar', MedicamentosUpdateController::class)->name('medicamento.alterar');

    Route::post('/entrada', [MedicamentosEntradaController::class, 'store']);

    Route::post('/saida', [MedicamentosSaidaaController::class, 'store']);

});

