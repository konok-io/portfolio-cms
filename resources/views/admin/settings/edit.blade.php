@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Site Settings</h1>
        <p class="admin-breadcrumb mb-0">Global settings for your website.</p>
    </div>
</div>

<x-validation-errors />

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3" id="contact-section">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <span>General</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="maintenanceMode" name="maintenance_mode" value="1" {{ old('maintenance_mode', $setting->maintenance_mode ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label small" for="maintenanceMode">Maintenance Mode</label>
                    </div>
                </div>
                <div class="card-body-custom">
                    @if($setting->maintenance_mode ?? false)
                        <div class="alert alert-warning mb-3">
                            <i class="fa-solid fa-exclamation-triangle me-2"></i>
                            <strong>Site is in Maintenance Mode!</strong> Only admins can see the site.
                        </div>
                    @endif
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label-admin">Website Name <span class="required-star">*</span></label>
                            <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $setting->site_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $setting->email) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $setting->phone) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Address</label>
                            <textarea name="address" class="form-control" rows="2" placeholder="123 Main Street, City, Country">{{ old('address', $setting->address) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Google Map URL</label>
                            <input type="url" name="google_map" class="form-control" value="{{ old('google_map', $setting->google_map) }}" placeholder="https://www.google.com/maps/@26.2760657,50.2151092,15z">
                            <small class="text-muted d-block mt-1 text-start">Paste a Google Maps share link (e.g., https://www.google.com/maps/@26.2760657,50.2151092,15z)</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header-custom">Social Links</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-facebook me-1"></i> Facebook</label>
                            <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $setting->facebook) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-x-twitter me-1"></i> Twitter / X</label>
                            <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $setting->twitter) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-linkedin me-1"></i> LinkedIn</label>
                            <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $setting->linkedin) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-github me-1"></i> GitHub</label>
                            <input type="url" name="github" class="form-control" value="{{ old('github', $setting->github) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-instagram me-1"></i> Instagram</label>
                            <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $setting->instagram) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-youtube me-1"></i> YouTube</label>
                            <input type="url" name="youtube" class="form-control" value="{{ old('youtube', $setting->youtube) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Logo</div>
                <div class="card-body-custom text-center">
                    @if($setting->logo_url)
                        <img src="{{ $setting->logo_url }}" id="logoPreview" class="mb-3" style="max-height:60px;">
                    @else
                        <img id="logoPreview" src="https://placehold.co/200x60/f1f5f9/64748b?text=Logo" class="mb-3 w-100">
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*" data-preview-target="#logoPreview">
                    <hr>
                    <label class="form-label text-start w-100 fw-semibold">Show in header</label>
                    <select name="header_display" class="form-select">
                        <option value="text" {{ ($setting->header_display ?? 'text') === 'text' ? 'selected' : '' }}>Website name (text) only</option>
                        <option value="logo" {{ ($setting->header_display ?? 'text') === 'logo' ? 'selected' : '' }}>Logo only</option>
                        <option value="both" {{ ($setting->header_display ?? 'text') === 'both' ? 'selected' : '' }}>Logo + website name</option>
                    </select>
                    <small class="text-muted d-block mt-2 text-start">Choose what appears in the site header. "Logo only" needs a logo uploaded.</small>
                    <hr>
                    <label class="form-label text-start w-100 fw-semibold">Default Language</label>
                    <select name="default_language" class="form-select">
                        <option value="en" {{ ($setting->default_language ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
                        <option value="ar" {{ ($setting->default_language ?? 'en') === 'ar' ? 'selected' : '' }}>العربية (Arabic)</option>
                        <option value="bn" {{ ($setting->default_language ?? 'en') === 'bn' ? 'selected' : '' }}>বাংলা (Bengali)</option>
                        <option value="ur" {{ ($setting->default_language ?? 'en') === 'ur' ? 'selected' : '' }}>اردو (Urdu)</option>
                        <option value="hi" {{ ($setting->default_language ?? 'en') === 'hi' ? 'selected' : '' }}>हिन्दी (Hindi)</option>
                        <option value="tl" {{ ($setting->default_language ?? 'en') === 'tl' ? 'selected' : '' }}>Filipino</option>
                        <option value="af" {{ ($setting->default_language ?? 'en') === 'af' ? 'selected' : '' }}>Afrikaans</option>
                        <option value="sq" {{ ($setting->default_language ?? 'en') === 'sq' ? 'selected' : '' }}>Shqip (Albanian)</option>
                        <option value="am" {{ ($setting->default_language ?? 'en') === 'am' ? 'selected' : '' }}>አማርኛ (Amharic)</option>
                        <option value="hy" {{ ($setting->default_language ?? 'en') === 'hy' ? 'selected' : '' }}>Հայերեն (Armenian)</option>
                        <option value="az" {{ ($setting->default_language ?? 'en') === 'az' ? 'selected' : '' }}>Azərbaycan (Azerbaijani)</option>
                        <option value="eu" {{ ($setting->default_language ?? 'en') === 'eu' ? 'selected' : '' }}>Euskara (Basque)</option>
                        <option value="be" {{ ($setting->default_language ?? 'en') === 'be' ? 'selected' : '' }}>Беларуская (Belarusian)</option>
                        <option value="bs" {{ ($setting->default_language ?? 'en') === 'bs' ? 'selected' : '' }}>Bosanski (Bosnian)</option>
                        <option value="ca" {{ ($setting->default_language ?? 'en') === 'ca' ? 'selected' : '' }}>Català (Catalan)</option>
                        <option value="ceb" {{ ($setting->default_language ?? 'en') === 'ceb' ? 'selected' : '' }}>Cebuano</option>
                        <option value="ny" {{ ($setting->default_language ?? 'en') === 'ny' ? 'selected' : '' }}>Chichewa</option>
                        <option value="zh-CN" {{ ($setting->default_language ?? 'en') === 'zh-CN' ? 'selected' : '' }}>中文 (Chinese Simplified)</option>
                        <option value="zh-TW" {{ ($setting->default_language ?? 'en') === 'zh-TW' ? 'selected' : '' }}>中文 (Chinese Traditional)</option>
                        <option value="co" {{ ($setting->default_language ?? 'en') === 'co' ? 'selected' : '' }}>Corsican</option>
                        <option value="hr" {{ ($setting->default_language ?? 'en') === 'hr' ? 'selected' : '' }}>Hrvatski (Croatian)</option>
                        <option value="cs" {{ ($setting->default_language ?? 'en') === 'cs' ? 'selected' : '' }}>Čeština (Czech)</option>
                        <option value="da" {{ ($setting->default_language ?? 'en') === 'da' ? 'selected' : '' }}>Dansk (Danish)</option>
                        <option value="nl" {{ ($setting->default_language ?? 'en') === 'nl' ? 'selected' : '' }}>Nederlands (Dutch)</option>
                        <option value="eo" {{ ($setting->default_language ?? 'en') === 'eo' ? 'selected' : '' }}>Esperanto</option>
                        <option value="et" {{ ($setting->default_language ?? 'en') === 'et' ? 'selected' : '' }}>Eesti (Estonian)</option>
                        <option value="tl" {{ ($setting->default_language ?? 'en') === 'fil' ? 'selected' : '' }}>Filipino</option>
                        <option value="fi" {{ ($setting->default_language ?? 'en') === 'fi' ? 'selected' : '' }}>Suomi (Finnish)</option>
                        <option value="fr" {{ ($setting->default_language ?? 'en') === 'fr' ? 'selected' : '' }}>Français (French)</option>
                        <option value="fy" {{ ($setting->default_language ?? 'en') === 'fy' ? 'selected' : '' }}>Frysk (Frisian)</option>
                        <option value="gl" {{ ($setting->default_language ?? 'en') === 'gl' ? 'selected' : '' }}>Galego (Galician)</option>
                        <option value="ka" {{ ($setting->default_language ?? 'en') === 'ka' ? 'selected' : '' }}>ქართული (Georgian)</option>
                        <option value="de" {{ ($setting->default_language ?? 'en') === 'de' ? 'selected' : '' }}>Deutsch (German)</option>
                        <option value="el" {{ ($setting->default_language ?? 'en') === 'el' ? 'selected' : '' }}>Ελληνικά (Greek)</option>
                        <option value="gu" {{ ($setting->default_language ?? 'en') === 'gu' ? 'selected' : '' }}>ગુજરાતી (Gujarati)</option>
                        <option value="ht" {{ ($setting->default_language ?? 'en') === 'ht' ? 'selected' : '' }}>Kreyòl Ayisyen (Haitian Creole)</option>
                        <option value="ha" {{ ($setting->default_language ?? 'en') === 'ha' ? 'selected' : '' }}>Hausa</option>
                        <option value="haw" {{ ($setting->default_language ?? 'en') === 'haw' ? 'selected' : '' }}>Hawaiian</option>
                        <option value="iw" {{ ($setting->default_language ?? 'en') === 'iw' ? 'selected' : '' }}>עברית (Hebrew)</option>
                        <option value="hi" {{ ($setting->default_language ?? 'en') === 'hi' ? 'selected' : '' }}>हिन्दी (Hindi)</option>
                        <option value="hmn" {{ ($setting->default_language ?? 'en') === 'hmn' ? 'selected' : '' }}>Hmong</option>
                        <option value="hu" {{ ($setting->default_language ?? 'en') === 'hu' ? 'selected' : '' }}>Magyar (Hungarian)</option>
                        <option value="is" {{ ($setting->default_language ?? 'en') === 'is' ? 'selected' : '' }}>Íslenska (Icelandic)</option>
                        <option value="ig" {{ ($setting->default_language ?? 'en') === 'ig' ? 'selected' : '' }}>Igbo</option>
                        <option value="id" {{ ($setting->default_language ?? 'en') === 'id' ? 'selected' : '' }}>Bahasa Indonesia (Indonesian)</option>
                        <option value="ga" {{ ($setting->default_language ?? 'en') === 'ga' ? 'selected' : '' }}>Gaeilge (Irish)</option>
                        <option value="it" {{ ($setting->default_language ?? 'en') === 'it' ? 'selected' : '' }}>Italiano (Italian)</option>
                        <option value="ja" {{ ($setting->default_language ?? 'en') === 'ja' ? 'selected' : '' }}>日本語 (Japanese)</option>
                        <option value="jw" {{ ($setting->default_language ?? 'en') === 'jw' ? 'selected' : '' }}>Javanese</option>
                        <option value="kn" {{ ($setting->default_language ?? 'en') === 'kn' ? 'selected' : '' }}>ಕನ್ನಡ (Kannada)</option>
                        <option value="kk" {{ ($setting->default_language ?? 'en') === 'kk' ? 'selected' : '' }}>Қазақ (Kazakh)</option>
                        <option value="km" {{ ($setting->default_language ?? 'en') === 'km' ? 'selected' : '' }}>Khmer</option>
                        <option value="rw" {{ ($setting->default_language ?? 'en') === 'rw' ? 'selected' : '' }}>Kinyarwanda</option>
                        <option value="ko" {{ ($setting->default_language ?? 'en') === 'ko' ? 'selected' : '' }}>한국어 (Korean)</option>
                        <option value="ku" {{ ($setting->default_language ?? 'en') === 'ku' ? 'selected' : '' }}>Kurdish</option>
                        <option value="ky" {{ ($setting->default_language ?? 'en') === 'ky' ? 'selected' : '' }}>Кыргызча (Kyrgyz)</option>
                        <option value="lo" {{ ($setting->default_language ?? 'en') === 'lo' ? 'selected' : '' }}>Lao</option>
                        <option value="la" {{ ($setting->default_language ?? 'en') === 'la' ? 'selected' : '' }}>Latin</option>
                        <option value="lv" {{ ($setting->default_language ?? 'en') === 'lv' ? 'selected' : '' }}>Latviešu (Latvian)</option>
                        <option value="lt" {{ ($setting->default_language ?? 'en') === 'lt' ? 'selected' : '' }}>Lietuvių (Lithuanian)</option>
                        <option value="lb" {{ ($setting->default_language ?? 'en') === 'lb' ? 'selected' : '' }}>Lëtzebuergesch (Luxembourgish)</option>
                        <option value="mk" {{ ($setting->default_language ?? 'en') === 'mk' ? 'selected' : '' }}>Македонски (Macedonian)</option>
                        <option value="mg" {{ ($setting->default_language ?? 'en') === 'mg' ? 'selected' : '' }}>Malagasy</option>
                        <option value="ms" {{ ($setting->default_language ?? 'en') === 'ms' ? 'selected' : '' }}>Bahasa Melayu (Malay)</option>
                        <option value="ml" {{ ($setting->default_language ?? 'en') === 'ml' ? 'selected' : '' }}>മലയാളം (Malayalam)</option>
                        <option value="mt" {{ ($setting->default_language ?? 'en') === 'mt' ? 'selected' : '' }}>Malti (Maltese)</option>
                        <option value="mi" {{ ($setting->default_language ?? 'en') === 'mi' ? 'selected' : '' }}>Māori</option>
                        <option value="mr" {{ ($setting->default_language ?? 'en') === 'mr' ? 'selected' : '' }}>मराठी (Marathi)</option>
                        <option value="mn" {{ ($setting->default_language ?? 'en') === 'mn' ? 'selected' : '' }}>Монгол (Mongolian)</option>
                        <option value="my" {{ ($setting->default_language ?? 'en') === 'my' ? 'selected' : '' }}>Myanmar (Burmese)</option>
                        <option value="ne" {{ ($setting->default_language ?? 'en') === 'ne' ? 'selected' : '' }}>नेपाली (Nepali)</option>
                        <option value="no" {{ ($setting->default_language ?? 'en') === 'no' ? 'selected' : '' }}>Norsk (Norwegian)</option>
                        <option value="ps" {{ ($setting->default_language ?? 'en') === 'ps' ? 'selected' : '' }}>پښتو (Pashto)</option>
                        <option value="fa" {{ ($setting->default_language ?? 'en') === 'fa' ? 'selected' : '' }}>فارسی (Persian)</option>
                        <option value="pl" {{ ($setting->default_language ?? 'en') === 'pl' ? 'selected' : '' }}>Polski (Polish)</option>
                        <option value="pt" {{ ($setting->default_language ?? 'en') === 'pt' ? 'selected' : '' }}>Português (Portuguese)</option>
                        <option value="pa" {{ ($setting->default_language ?? 'en') === 'pa' ? 'selected' : '' }}>ਪੰਜਾਬੀ (Punjabi)</option>
                        <option value="ro" {{ ($setting->default_language ?? 'en') === 'ro' ? 'selected' : '' }}>Română (Romanian)</option>
                        <option value="ru" {{ ($setting->default_language ?? 'en') === 'ru' ? 'selected' : '' }}>Русский (Russian)</option>
                        <option value="sm" {{ ($setting->default_language ?? 'en') === 'sm' ? 'selected' : '' }}>Samoan</option>
                        <option value="gd" {{ ($setting->default_language ?? 'en') === 'gd' ? 'selected' : '' }}>Gàidhlig (Scottish Gaelic)</option>
                        <option value="sr" {{ ($setting->default_language ?? 'en') === 'sr' ? 'selected' : '' }}>Српски (Serbian)</option>
                        <option value="st" {{ ($setting->default_language ?? 'en') === 'st' ? 'selected' : '' }}>Sesotho</option>
                        <option value="sn" {{ ($setting->default_language ?? 'en') === 'sn' ? 'selected' : '' }}>Shona</option>
                        <option value="sd" {{ ($setting->default_language ?? 'en') === 'sd' ? 'selected' : '' }}>سنڌي (Sindhi)</option>
                        <option value="si" {{ ($setting->default_language ?? 'en') === 'si' ? 'selected' : '' }}>සිංහල (Sinhala)</option>
                        <option value="sk" {{ ($setting->default_language ?? 'en') === 'sk' ? 'selected' : '' }}>Slovenčina (Slovak)</option>
                        <option value="sl" {{ ($setting->default_language ?? 'en') === 'sl' ? 'selected' : '' }}>Slovenščina (Slovenian)</option>
                        <option value="so" {{ ($setting->default_language ?? 'en') === 'so' ? 'selected' : '' }}>Soomaali (Somali)</option>
                        <option value="es" {{ ($setting->default_language ?? 'en') === 'es' ? 'selected' : '' }}>Español (Spanish)</option>
                        <option value="su" {{ ($setting->default_language ?? 'en') === 'su' ? 'selected' : '' }}> Sundanese</option>
                        <option value="sw" {{ ($setting->default_language ?? 'en') === 'sw' ? 'selected' : '' }}>Kiswahili (Swahili)</option>
                        <option value="sv" {{ ($setting->default_language ?? 'en') === 'sv' ? 'selected' : '' }}>Svenska (Swedish)</option>
                        <option value="tg" {{ ($setting->default_language ?? 'en') === 'tg' ? 'selected' : '' }}>Тоҷикӣ (Tajik)</option>
                        <option value="ta" {{ ($setting->default_language ?? 'en') === 'ta' ? 'selected' : '' }}>தமிழ் (Tamil)</option>
                        <option value="tt" {{ ($setting->default_language ?? 'en') === 'tt' ? 'selected' : '' }}>Татар (Tatar)</option>
                        <option value="te" {{ ($setting->default_language ?? 'en') === 'te' ? 'selected' : '' }}>తెలుగు (Telugu)</option>
                        <option value="th" {{ ($setting->default_language ?? 'en') === 'th' ? 'selected' : '' }}>ไทย (Thai)</option>
                        <option value="tr" {{ ($setting->default_language ?? 'en') === 'tr' ? 'selected' : '' }}>Türkçe (Turkish)</option>
                        <option value="tk" {{ ($setting->default_language ?? 'en') === 'tk' ? 'selected' : '' }}>Тürkmen (Turkmen)</option>
                        <option value="uk" {{ ($setting->default_language ?? 'en') === 'uk' ? 'selected' : '' }}>Українська (Ukrainian)</option>
                        <option value="ur" {{ ($setting->default_language ?? 'en') === 'ur' ? 'selected' : '' }}>اردو (Urdu)</option>
                        <option value="ug" {{ ($setting->default_language ?? 'en') === 'ug' ? 'selected' : '' }}>ئۇيغۇر (Uyghur)</option>
                        <option value="uz" {{ ($setting->default_language ?? 'en') === 'uz' ? 'selected' : '' }}>O'zbek (Uzbek)</option>
                        <option value="vi" {{ ($setting->default_language ?? 'en') === 'vi' ? 'selected' : '' }}>Tiếng Việt (Vietnamese)</option>
                        <option value="cy" {{ ($setting->default_language ?? 'en') === 'cy' ? 'selected' : '' }}>Cymraeg (Welsh)</option>
                        <option value="xh" {{ ($setting->default_language ?? 'en') === 'xh' ? 'selected' : '' }}>isiXhosa (Xhosa)</option>
                        <option value="yi" {{ ($setting->default_language ?? 'en') === 'yi' ? 'selected' : '' }}>ייִדיש (Yiddish)</option>
                        <option value="yo" {{ ($setting->default_language ?? 'en') === 'yo' ? 'selected' : '' }}>Yorùbá (Yoruba)</option>
                        <option value="zu" {{ ($setting->default_language ?? 'en') === 'zu' ? 'selected' : '' }}>isiZulu (Zulu)</option>
                    </select>
                    <small class="text-muted d-block mt-2 text-start">Set the default language for Google Translate.</small>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-custom">Favicon</div>
                <div class="card-body-custom text-center">
                    @if($setting->favicon_url)
                        <img src="{{ $setting->favicon_url }}" id="faviconPreview" class="mb-3" style="width:48px;height:48px;">
                    @else
                        <img id="faviconPreview" src="https://placehold.co/48x48/f1f5f9/64748b?text=Fav" class="mb-3">
                    @endif
                    <input type="file" name="favicon" class="form-control" accept="image/*" data-preview-target="#faviconPreview">
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary w-100 py-2">
                <i class="fa-solid fa-floppy-disk me-2"></i>Save Settings
            </button>
        </div>
    </div>
</form>

@endsection
