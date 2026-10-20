<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

// مسار عرض الصفحة الرئيسية
Route::get('/', [UrlController::class, 'index'])->name('home');

// مسار اختصار الرابط (POST)
Route::post('/shorten', [UrlController::class, 'store'])->name('url.shorten');

// [جديد] مسار لوحة التحكم لعرض الروابط والـ Clicks
Route::get('/dashboard', [UrlController::class, 'dashboard'])->name('url.dashboard');

// مسار التوجيه (يجب أن يكون دائماً في نهاية الملف)
Route::get('/{code}', [UrlController::class, 'redirect'])->name('url.redirect');