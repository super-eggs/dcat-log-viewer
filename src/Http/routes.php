<?php

use SuperEggs\Dcat\LogViewer\Http\Controllers;
use Illuminate\Support\Facades\Route;

//Route::get('log-viewer', Controllers\LogViewerController::class.'@index');
Route::get('logs-view', Controllers\LogViewerController::class.'@index')->name('log-viewer-index');
Route::get('logs-view/{file}', Controllers\LogViewerController::class.'@index')->name('log-viewer-file');
Route::get('logs-view/{file}/tail', Controllers\LogViewerController::class.'@index')->name('log-viewer-tail');
