<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Localization;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index(Request $request)
    {

        $locale     = $request->get('locale', app()->getLocale());
        $language   = Language::where('code', $locale)->first();
        $languageId = $language->id;
        $direction  = $language->direction;

        $defaultLanguageId = Language::where('code', 'en')->value('id');
        $countryId = 1; // Assuming a fixed country_id for the example

        if (!$languageId) {
            return redirect()->back()->with('error', 'Selected language does not exist.');
        }

        // Check if localizations exist for the selected language
        $localizations = Localization::where('language_id', $languageId)->paginate(50);

        // If no localizations exist for the selected language, copy from default (English)
        if ($localizations->isEmpty()) {
            $defaultLocalizations = Localization::where('language_id', $defaultLanguageId)->get();

            foreach ($defaultLocalizations as $defaultLocalization) {
                Localization::create([
                    'key' => $defaultLocalization->key,
                    'language_id' => $languageId,
                    'value' => $defaultLocalization->value,
                ]);
            }

            // Refresh the localizations after copying
            $localizations = Localization::where('language_id', $languageId)->paginate(50);
        }

        // cacheClear();

        return view('dashboard.version1.localizations.index', compact('localizations', 'locale', "languageId", "direction"));
    }

    public function edit(Localization $localization)
    {
        $languages = Language::all();
        return view('dashboard.version1.localizations.edit', compact('localization', 'languages'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::query()->findOrFail($id);
        foreach ($request->key as $key => $value) {
              if (!empty($request->value[$key])) {
                $localization = Localization::query()

                    ->updateOrCreate([
                        "language_id" => $language->id,
                        "key"         => $value
                    ], [
                        "language_id" => $language->id,
                        "key"         => str_replace(" ", "_", strtolower($value)),
                        "value"       => $request->value[$key]
                    ]);
              }
            
        }

        // cacheClear();

        return redirect()->route('admin.localizations.index', $language->code ? "locale=$$language->code" : "")
            ->with('success', 'Localization updated successfully');
    }

}
