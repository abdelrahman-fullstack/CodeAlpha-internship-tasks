<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    // 1. عرض الواجهة الرئيسية لإدخال الروابط
    public function index()
    {
        return view('welcome');
    }

    // 2. استقبال الرابط الطويل وتوليد الكود المختصر
    public function store(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url'
        ]);

        $existingUrl = Url::where('long_url', $request->long_url)->first();
        if ($existingUrl) {
            return back()->with('short_url', url($existingUrl->short_code));
        }

        do {
            $shortCode = Str::random(6);
        } while (Url::where('short_code', $shortCode)->exists());

        $url = Url::create([
            'short_code' => $shortCode,
            'long_url'   => $request->long_url,
        ]);

        return back()->with('short_url', url($url->short_code));
    }

    // 3. التوجيه (Redirect) عند زيارة الرابط القصير وزيادة عداد الـ Clicks
    public function redirect($code)
    {
        $url = Url::where('short_code', $code)->firstOrFail();

        // زيادة عدد الزيارات بمقدار 1
        $url->increment('clicks');

        return redirect()->away($url->long_url);
    }

    // 4. [جديد] عرض لوحة التحكم بجميع الروابط والإحصائيات
    public function dashboard()
    {
        // جلب جميع الروابط من قاعدة البيانات مرتبة من الأحدث للأقدم
        $urls = Url::latest()->get();

        return view('dashboard', compact('urls'));
    }
}