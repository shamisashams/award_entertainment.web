<?php
/**
 *  app/Http/View/Composers/LanguageComposer.php
 *
 * Date-Time: 07.06.21
 * Time: 13:22
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\View\Composers;


use App\Models\Category;
use App\Models\Company;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\View\View;

/**
 * Class LanguageComposer
 * @package App\Http\View\Composers
 */
class LanguageComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {

        $defaultLanguage = Language::where('default', true)->first();
        $activeLanguage = Language::where('locale', $this->languageSlug())->first();
        $companies = Company::with(["files", "availableLanguage"])->where("status", 1)->get();

//        $categories = Category::where('status',true)->get();


//        $gaddress = Setting::where('key','address')->first();
//        $gemail = Setting::where('key','contact_email')->first();
//        $gphone = Setting::where('key','phone')->first();
//        $ginstagram = Setting::where('key','instagram')->first();
//        $gfacebook = Setting::where('key','facebook')->first();
//        $gyoutube = Setting::where('key','youtube')->first();
//        $gtwitter = Setting::where('key','twitter')->first();
//        $gabout = Setting::where('key','about')->first();
//        $gcity = Setting::where("key", "city")->first();


        $gaddress = "";
        $gemail = "";
        $gphone = "";
        $ginstagram = "";
        $gfacebook = "";
        $gyoutube = "";
        $gtwitter = "";
        $gabout = "";
        $gcity = "";


        $settings = Setting::get();
        foreach ($settings as $setting){
            switch ($setting->key){
                case "address":
                    $gaddress = $setting;
                    break;
                case "contact_email":
                    $gemail = $setting;
                    break;
                case "phone":
                    $gphone = $setting;
                    break;
                case "instagram":
                    $ginstagram = $setting;
                    break;
                case "facebook":
                    $gfacebook = $setting;
                    break;
                case "youtube":
                    $gyoutube = $setting;
                    break;
                case "twitter":
                    $gtwitter = $setting;
                    break;
                case "about":
                    $gabout = $setting;
                    break;
                case "city":
                    $gcity = $setting;
                    break;
            }
        }

        $view->with('localizations', $this->languageItems())
            ->with('activeLanguage', $activeLanguage ? $activeLanguage->id : null)
            ->with('gaddress',$gaddress)
            ->with('ginstagram',$ginstagram)
            ->with('gfacebook',$gfacebook)
            ->with('gyoutube',$gyoutube)
            ->with('gtwitter',$gtwitter)
            ->with('gemail',$gemail)
            ->with('gphone',$gphone)
            ->with("gcity",$gcity)
            ->with("gabout", $gabout)
            ->with("companies", $companies)
            ->with('defaultLanguage', $defaultLanguage ? $defaultLanguage->id : null);
    }

    /**
     * @return array
     */
    public function languageItems(): array
    {
        $localizations = Language::where('status', true)->get();
        $languages = [];
        $languages['data'] = [];
        if (count($localizations) > 0) {
            foreach ($localizations as $localization) {
                if ($this->isCurrent($localization->locale)) {
                    $languages['current'] = [
                        'title' => $localization->title,
                        'url' => '',
                        'locale' => $localization->locale
                    ];
                    continue;
                }
                $languages['data'][] = [
                    'title' => $localization->title,
                    'url' => $this->getUrl($localization->locale),
                    'locale' => $localization->locale
                ];
            }
        }
        return $languages;
    }

    /**
     * @param $lang
     *
     * @return string
     */
    protected function getUrl($lang): string
    {

        $host = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $uriSegments[1] = $lang;

        $uriSegments = implode('/', $uriSegments);
        return $host . $uriSegments;
    }


    protected function isCurrent(string $lang): bool
    {
        return $this->languageSlug() === $lang;
    }

    protected function languageSlug()
    {
        return explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[1];
    }
}
