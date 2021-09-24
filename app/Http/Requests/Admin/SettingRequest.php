<?php
/**
 *  app/Http/Requests/Admin/CityRequest.php
 *
 * Date-Time: 09.06.21
 * Time: 14:46
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CityRequest
 * @package App\Http\Requests\Admin
 */
class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // Check if method is get,fields are nullable.
        $isRequired = $this->method() === 'GET' ? 'nullable' : 'required';
        $defaultLanguage = Language::where('default', true)->firstOrFail();

        $data = [

        ];

        if ($this->method !== 'GET') {
            $data ['value.' . $defaultLanguage->id] = 'required|string|max:255';
        }
        return $data;
    }
}
