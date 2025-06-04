<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $casts = [
        'value' => 'array'
    ];

    protected $fillable = ['key', 'value'];

    public static function getLanguage()
    {
        $settings = self::where('key', 'general')->first();
        $language = $settings?->value['language'] ?? config('app.locale');
        
        // Store in session to persist
        session(['locale' => $language]);
        
        return $language;
    }

    public static function setLanguage($language)
    {
        $settings = self::where('key', 'general')->first();
        if ($settings) {
            $value = $settings->value;
            $value['language'] = $language;
            $settings->value = $value;
            $settings->save();
        }

        session(['locale' => $language]);
    }
}