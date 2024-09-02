<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
// routes/web.php

//O CATALOGO ESTÁ COMPLETO EM FERRAMENTAS, PORÉM NENHUMA FOI APLICADA AINDA


// Rota para exibir o catálogo
Route::get('/catalogo', function () {
    // Busca os livros do banco de dados
    $books = DB::table('books')->select('imageUrl', 'title', 'author', 'description')->get();

    // Passa os dados dos livros para a view 'catalogo.catalogo'
    return view('catalogo.catalogo', ['books' => $books]);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('/category', CategoryController::class)->middleware('role:Administrator');
    Route::resource('/products', ProductController::class)->middleware('role:Administrator|Manager');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
