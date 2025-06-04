<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $waterThresholds = Setting::where('key', 'water_thresholds')->first()?->value ?? config('water_thresholds');
        $generalSettings = Setting::where('key', 'general')->first()?->value ?? ['water_refresh_days' => 14];
        
        return view('settings.index', compact('waterThresholds', 'generalSettings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'general.language' => ['required', 'string', 'in:nl,en,de,fr'],
            'general.water_refresh_days' => ['required', 'integer', 'min:1', 'max:90'],
        ]);

        // Update settings in database
        $settings = Setting::where('key', 'general')->first();
        $settings->update([
            'value' => array_merge($settings->value, $validated['general'])
        ]);

        // Update session locale
        session(['locale' => $validated['general']['language']]);

        // Log for debugging
        \Log::info('Language updated', [
            'new_language' => $validated['general']['language'],
            'session_locale' => session('locale'),
            'app_locale' => app()->getLocale()
        ]);

        return redirect()
            ->back()
            ->with('success', __('settings.success'));
    }
}