<?php
/**
 *  app/Http/Requests/Admin/FeatureRequest.php
 *
 * Date-Time: 08.06.21
 * Time: 14:26
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FeatureRequest
 * @package App\Http\Requests\Admin
 */
class FeatureRequest extends FormRequest
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
            'position' => 'nullable|string|max:255',
            'type' => $isRequired . '|in:input,textarea,checkbox,radio,select',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ];

        if ($this->method !== 'GET') {
            $data ['title.' . $defaultLanguage->id] = 'required|string|max:255';
        }
        return $data;
    }
}
