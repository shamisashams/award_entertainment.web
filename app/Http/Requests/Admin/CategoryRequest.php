<?php
/**
 *  app/Http/Requests/Admin/CategoryRequest.php
 *
 * Date-Time: 07.06.21
 * Time: 17:03
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CategoryRequest
 * @package App\Http\Requests\Admin
 */
class CategoryRequest extends FormRequest
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
            'slug' => [$isRequired,'alpha_dash', Rule::unique('categories', 'slug')->ignore($this->category)],
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
        ];

        if ($this->method !== 'GET') {
            $data ['title.' . $defaultLanguage->id] = 'required|string|max:255';
            $data ['description.' . $defaultLanguage->id] = 'required|string|max:255';
        }
        return $data;
    }
}
