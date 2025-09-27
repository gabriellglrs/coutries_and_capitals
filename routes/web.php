<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'startGame'])->name('start_game');
Route::post('/prepare_game', [MainController::class, 'prepareGame'])->name('prepare_game');

Route::get('/quiz/question/{question_number}', [MainController::class, 'showQuestion'])->name('show_question');
Route::post('/quiz/process_answer/{question_number}', [MainController::class, 'processAnswer'])->name('process_answer');
Route::get('/quiz/results', [MainController::class, 'showResults'])->name('show_results');
