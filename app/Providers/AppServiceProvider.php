<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;
use App\Models\Settings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Available application locales
     */
    private const AVAILABLE_LOCALES = ['nl', 'en', 'de', 'fr'];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureLocalization();
        $this->configureFormatting();
    }

    /**
     * Configure application localization settings.
     */
    private function configureLocalization(): void
    {
        try {
            $settings = Settings::where('key', 'general')->first();
            $locale = $settings?->value['language'] ?? config('app.locale');
            
            if (in_array($locale, self::AVAILABLE_LOCALES)) {
                App::setLocale($locale);
                Carbon::setLocale($locale);
            }
        } catch (\Exception) {
            // Silently fail if database is not available (during migrations)
        }
    }

    /**
     * Configure number formatting Blade directive.
     */
    private function configureFormatting(): void
    {
        Blade::directive('number', function ($expression) {
            return "<?php echo number_format($expression, 2, ',', '.'); ?>";
        });
    }
}
