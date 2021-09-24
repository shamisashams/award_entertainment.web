<?php
/**
 *  app/Providers/AppServiceProvider.php
 *
 * Date-Time: 07.06.21
 * Time: 15:32
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Providers;

use App\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Request::macro('breadcrumbs',function () {
            return new Breadcrumbs($this);
        });
    }
}
