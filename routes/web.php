<?php
/**
 *  routes/web.php
 *
 * Date-Time: 03.06.21
 * Time: 15:41
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BlogController as BlogControllerAdmin;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\BlogController as BlogControllerClient;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\GalleryController as GalleryControllerAdmin;
use App\Http\Controllers\Client\GalleryController as GalleryControllerClient;
use App\Http\Controllers\Admin\HnhController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
Route::post('ckeditor/image_upload/{type}', [CKEditorController::class, 'upload'])->name('upload');


Route::prefix('{locale?}')
    ->middleware(['setlocale'])
    ->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('login', [LoginController::class, 'loginView'])->name('loginView');
            Route::post('login', [LoginController::class, 'login'])->name('login');

            Route::redirect('', 'admin/language');

            Route::middleware('auth')->group(function () {
                Route::get('logout', [LoginController::class, 'logout'])->name('logout');

                //Language
                Route::resource('language', LanguageController::class);
                Route::get('language/{language}/destroy', [LanguageController::class, 'destroy'])->name('language.destroy');

                // Translation
                Route::resource('translation', TranslationController::class);

                // Slider
                Route::resource('slider', SliderController::class);
                Route::get('slider/{slider}/destroy', [SliderController::class, 'destroy'])->name('slider.destroy');

                // City
                Route::resource('setting', SettingController::class);

                //Blog
                Route::resource('blog', BlogControllerAdmin::class);
                Route::get('blog/{blog}/destroy', [BlogControllerAdmin::class, 'destroy'])->name('blog.destroy');

                //Gallery
                Route::resource('gallery', GalleryControllerAdmin::class);
                Route::get('gallery/{gallery}/destroy', [GalleryControllerAdmin::class, 'destroy'])->name('gallery.destroy');

                //Page
                Route::resource('page', PageController::class);
//                Route::get('gallery/{gallery}/destroy', [GalleryControllerAdmin::class, 'destroy'])->name('gallery.destroy');

                //Company
                Route::resource('company', CompanyController::class);
                Route::get('company/{company}/destroy', [CompanyController::class, 'destroy'])->name('company.destroy');

            });
        });

        Route::get('', [HomeController::class, 'index'])->name('home.index');

        Route::get('/blog', [BlogControllerClient::class, 'index'])->name('client.blog.index');
        Route::get('/gallery', [GalleryControllerClient::class, 'index'])->name('client.gallery.index');
        Route::get('/gallery/{gallery}', [GalleryControllerClient::class, 'show'])->name('client.gallery.show');
        Route::get("about", [AboutController::class, 'index'])->name("about");
        Route::post( '/contact-us', [ContactController::class, 'index'])->name('contact.index');




    });

