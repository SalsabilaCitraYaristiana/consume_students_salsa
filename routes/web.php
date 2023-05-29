<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


// mengambil smua data dan search
Route::get ('/', [StudentController::class, 'index']);
// halaman tambah data
Route::get ('/add', [StudentController::class, 'create'])->name('add');
// tambah data
Route::post ('/add/send', [StudentController::class, 'store'])->name('send');
// menampilkan halaman edit dan mengirim satu datanya
Route::get ('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
// mengubah data
Route::patch ('/update/{id}', [StudentController::class, 'update'])->name('update');
// hapus data
Route::delete ('/delete/{id}', [StudentController::class, 'destroy'])->name('delete');
// ambil data sampah
Route::get ('/trash', [StudentController::class, 'trash'])->name('trash');
// restore
Route::get ('/trash/restore/{id}', [StudentController::class, 'restore'])->name('restore');
// hapus data permanent
Route::get ('/trash/delete/permanent/{id}', [StudentController::class, 'permanent'])->name('permanent');
