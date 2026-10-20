<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    // السماح بدخول هذه البيانات عن طريق الـ Controller
    protected $fillable = ['short_code', 'long_url', 'clicks'];
}