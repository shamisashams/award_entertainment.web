<?php
/**
 *  app/Http/Middleware/SetLocale.php
 *
 * Date-Time: 04.06.21
 * Time: 13:46
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class SetLocale
 * @package App\Http\Middleware
 */
class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);
        $segments = $request->segments();
        $language = Language::where('locale', $locale)->first();
        $defaultLocale = Language::where('default', true)->first();
        if ($language === null) {
            if (strlen($locale) === 2) {
                array_shift($segments);
            }
            array_unshift($segments, $defaultLocale->locale);
            return $this->redirectTo($segments);
        }
        if (!$language->status) {
            array_shift($segments);
            return $this->redirectTo($segments);
        }
        app()->setLocale($language->id);
        return $next($request);
    }

    /**
     * Redirect to default language.
     *
     * @param array $segments
     *
     * @return RedirectResponse
     */
    protected function redirectTo(array $segments): RedirectResponse
    {
        return redirect()->to(implode('/', $segments));
    }
}
