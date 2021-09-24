<?php
/**
 *  app/Http/Requests/Admin/SliderRequest.php
 *
 * Date-Time: 14.06.21
 * Time: 15:25
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SliderRequest
 * @package App\Http\Requests\Admin
 */
class SliderRequest extends FormRequest
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
    public function rules()
    {
        // Check if method is get,fields are nullable.
        $isRequired = $this->method() === 'GET' ? 'nullable' : 'required';
        $defaultLanguage = Language::where('default', true)->firstOrFail();

        $data = [
        ];
        if ($this->method() !== 'GET') {
            $data ['title.' . $defaultLanguage->id] = 'required|string|max:255';
            $data ['description.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data ['description.' . $defaultLanguage->id] = 'nullable|string|max:255';

        }
        return $data;
    }
}
