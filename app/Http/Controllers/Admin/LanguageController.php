<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageStoreRequest;
use App\Http\Requests\Admin\LanguageUpdateRequest;
use App\Models\DistrackModel;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->languageWithCodes();
        $languages = \App\Models\Language::paginate();
        return view('dashboard.version1.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.version1.languages.add_language');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageStoreRequest $request)
    {
        //dd($request->validated());

        Language::query()->create($request->validated());

        flashMessage("success", "Language created successfully");

        return to_route('admin.languages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        //dd($language);
        return view('dashboard.version1.languages.edit_language', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageUpdateRequest $request, string $id)
    {
        $language = Language::query()->find($id);
        $language->update($request->validated());

        flashMessage("success", "Language updated successfully");

        return to_route('admin.languages.index');
    }


    public function destroy(Request $request, Language $language)
    {
        try {
            $language->delete();

            flashMessage("Language deleted successfully");

            return to_route("admin.languages.index");
        } catch (\Throwable $e) {
            commonLog("Failed to Delete Model", errorArray($e));

            return back();
        }
    }

    // public function languageWithCodes()
    // {
    //     $languages = [
    //         'Abkhazian' => 'ab',
    //         'Afar' => 'aa',
    //         'Afrikaans' => 'af',
    //         'Akan' => 'ak',
    //         'Albanian' => 'sq',
    //         'Amharic' => 'am',
    //         'Arabic' => 'ar',
    //         'Aragonese' => 'an',
    //         'Armenian' => 'hy',
    //         'Assamese' => 'as',
    //         'Avaric' => 'av',
    //         'Avestan' => 'ae',
    //         'Aymara' => 'ay',
    //         'Azerbaijani' => 'az',
    //         'Bambara' => 'bm',
    //         'Bashkir' => 'ba',
    //         'Basque' => 'eu',
    //         'Belarusian' => 'be',
    //         'Bengali' => 'bn',
    //         'Bihari languages' => 'bh',
    //         'Bislama' => 'bi',
    //         'Bosnian' => 'bs',
    //         'Breton' => 'br',
    //         'Bulgarian' => 'bg',
    //         'Burmese' => 'my',
    //         'Catalan; Valencian' => 'ca',
    //         'Chamorro' => 'ch',
    //         'Chechen' => 'ce',
    //         'Chichewa; Chewa; Nyanja' => 'ny',
    //         'Chinese' => 'zh',
    //         'Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic' => 'cu',
    //         'Chuvash' => 'cv',
    //         'Cornish' => 'kw',
    //         'Corsican' => 'co',
    //         'Cree' => 'cr',
    //         'Croatian' => 'hr',
    //         'Czech' => 'cs',
    //         'Danish' => 'da',
    //         'Divehi; Dhivehi; Maldivian' => 'dv',
    //         'Dutch; Flemish' => 'nl',
    //         'Dzongkha' => 'dz',
    //         'English' => 'en',
    //         'Esperanto' => 'eo',
    //         'Estonian' => 'et',
    //         'Ewe' => 'ee',
    //         'Faroese' => 'fo',
    //         'Fijian' => 'fj',
    //         'Finnish' => 'fi',
    //         'French' => 'fr',
    //         'Fulah' => 'ff',
    //         'Galician' => 'gl',
    //         'Georgian' => 'ka',
    //         'German' => 'de',
    //         'Greek, Modern (1453-)' => 'el',
    //         'Guarani' => 'gn',
    //         'Gujarati' => 'gu',
    //         'Haitian; Haitian Creole' => 'ht',
    //         'Hausa' => 'ha',
    //         'Hebrew' => 'he',
    //         'Herero' => 'hz',
    //         'Hindi' => 'hi',
    //         'Hiri Motu' => 'ho',
    //         'Hungarian' => 'hu',
    //         'Icelandic' => 'is',
    //         'Ido' => 'io',
    //         'Igbo' => 'ig',
    //         'Indonesian' => 'id',
    //         'Interlingua (International Auxiliary Language Association)' => 'ia',
    //         'Interlingue; Occidental' => 'ie',
    //         'Inuktitut' => 'iu',
    //         'Inupiaq' => 'ik',
    //         'Irish' => 'ga',
    //         'Italian' => 'it',
    //         'Japanese' => 'ja',
    //         'Javanese' => 'jv',
    //         'Kalaallisut; Greenlandic' => 'kl',
    //         'Kannada' => 'kn',
    //         'Kanuri' => 'kr',
    //         'Kashmiri' => 'ks',
    //         'Kazakh' => 'kk',
    //         'Kikuyu; Gikuyu' => 'ki',
    //         'Kinyarwanda' => 'rw',
    //         'Kirghiz; Kyrgyz' => 'ky',
    //         'Komi' => 'kv',
    //         'Kongo' => 'kg',
    //         'Korean' => 'ko',
    //         'Kuanyama; Kwanyama' => 'kj',
    //         'Kurdish' => 'ku',
    //         'Lao' => 'lo',
    //         'Latin' => 'la',
    //         'Latvian' => 'lv',
    //         'Limburgan; Limburger; Limburgish' => 'li',
    //         'Lingala' => 'ln',
    //         'Lithuanian' => 'lt',
    //         'Luba-Katanga' => 'lu',
    //         'Luxembourgish; Letzeburgesch' => 'lb',
    //         'Macedonian' => 'mk',
    //         'Malagasy' => 'mg',
    //         'Malay' => 'ms',
    //         'Malayalam' => 'ml',
    //         'Maltese' => 'mt',
    //         'Manx' => 'gv',
    //         'Maori' => 'mi',
    //         'Marathi' => 'mr',
    //         'Marshallese' => 'mh',
    //         'Mongolian' => 'mn',
    //         'Nauru' => 'na',
    //         'Navajo; Navaho' => 'nv',
    //         'Ndebele, North; North Ndebele' => 'nd',
    //         'Ndebele, South; South Ndebele' => 'nr',
    //         'Ndonga' => 'ng',
    //         'Nepali' => 'ne',
    //         'Northern Sami' => 'se',
    //         'Norwegian' => 'no',
    //         'Norwegian Nynorsk; Nynorsk, Norwegian' => 'nn',
    //         'Occitan (post 1500)' => 'oc',
    //         'Ojibwa' => 'oj',
    //         'Oriya' => 'or',
    //         'Oromo' => 'om',
    //         'Ossetian; Ossetic' => 'os',
    //         'Pali' => 'pi',
    //         'Panjabi; Punjabi' => 'pa',
    //         'Persian' => 'fa',
    //         'Polish' => 'pl',
    //         'Portuguese' => 'pt',
    //         'Pushto; Pashto' => 'ps',
    //         'Quechua' => 'qu',
    //         'Romanian; Moldavian; Moldovan' => 'ro',
    //         'Romansh' => 'rm',
    //         'Rundi' => 'rn',
    //         'Russian' => 'ru',
    //         'Samoan' => 'sm',
    //         'Sango' => 'sg',
    //         'Sanskrit' => 'sa',
    //         'Sardinian' => 'sc',
    //         'Serbian' => 'sr',
    //         'Shona' => 'sn',
    //         'Sindhi' => 'sd',
    //         'Sinhala; Sinhalese' => 'si',
    //         'Slovak' => 'sk',
    //         'Slovenian' => 'sl',
    //         'Somali' => 'so',
    //         'Sotho, Southern' => 'st',
    //         'Spanish; Castilian' => 'es',
    //         'Sundanese' => 'su',
    //         'Swahili' => 'sw',
    //         'Swati' => 'ss',
    //         'Swedish' => 'sv',
    //         'Tahitian' => 'ty',
    //         'Tajik' => 'tg',
    //         'Tamil' => 'ta',
    //         'Tatar' => 'tt',
    //         'Telugu' => 'te',
    //         'Thai' => 'th',
    //         'Tibetan' => 'bo',
    //         'Tigrinya' => 'ti',
    //         'Tonga (Tonga Islands)' => 'to',
    //         'Tsonga' => 'ts',
    //         'Tswana' => 'tn',
    //         'Turkish' => 'tr',
    //         'Turkmen' => 'tk',
    //         'Twi' => 'tw',
    //         'Uighur; Uyghur' => 'ug',
    //         'Ukrainian' => 'uk',
    //         'Urdu' => 'ur',
    //         'Uzbek' => 'uz',
    //         'Venda' => 've',
    //         'Vietnamese' => 'vi',
    //         'Volapük' => 'vo',
    //         'Walloon' => 'wa',
    //         'Welsh' => 'cy',
    //         'Wolof' => 'wo',
    //         'Xhosa' => 'xh',
    //         'Yiddish' => 'yi',
    //         'Yoruba' => 'yo',
    //         'Zhuang; Chuang' => 'za',
    //         'Zulu' => 'zu',
    //     ];

    //     foreach ($languages as $key => $value) {
    //         Language::query()->updateOrCreate([
    //             'code' => $value
    //         ], [
    //             'name' => $key,
    //             'code' => $value,
    //             'is_active' => 1,
    //         ]);
    //     }
    // }
}
