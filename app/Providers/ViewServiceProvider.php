<?php
/**
 *  app/Providers/ViewServiceProvider.php
 *
 * Date-Time: 07.06.21
 * Time: 13:26
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Providers;

use App\Http\View\Composers\LanguageComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

/**
 * Class ViewServiceProvider
 * @package App\Providers
 */
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        View::composer(['client.layout.partial.footer','client.pages.home.index'], 'App\Http\View\Composers\LanguageComposer');
        View::composer("*", 'App\Http\View\Composers\LanguageComposer');

    }
}
