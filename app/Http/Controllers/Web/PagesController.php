<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PagesController extends Controller
{
    public function show($slug)
    {
        $languageCodes = \App\Models\Language::pluck('code')->toArray();
        if (in_array($slug, $languageCodes)) {
            session(['lang' => $slug]);
            return redirect()->back();
        }
        // Fallback for non-language slugs (like pages)
        $data = config('contents.data.' . $slug);
        if (!$data) {
            abort(404);
        }
        $view = 'web.pages.' . $data['page'];
        App::setLocale(session('lang', 'en')); // Default to 'en' if no session
        return view($view, ['metaTitle' => $data['title'], 'data' => $data]);
    }

    public function microsoft()
    {
        return view('web.pages.homepage-ms');
    }
}
