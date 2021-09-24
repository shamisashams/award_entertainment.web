<?php
/**
 *  app/Http/Requests/Admin/ProductRequest.php
 *
 * Date-Time: 10.06.21
 * Time: 15:07
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ProductRequest
 * @package App\Http\Requests\Admin
 */
class HnhRequest extends FormRequest
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
            'slug' => [$isRequired, 'alpha_dash', Rule::unique('products', 'slug')->ignore($this->product)],
            'price' => $isRequired . '|numeric'
        ];

        if ($this->method !== 'GET') {
            $data ['meta_title.' . $defaultLanguage->id] = 'required|string|max:255';
            $data ['meta_description.' . $defaultLanguage->id] = 'required|string|max:255';
            $data ['meta_keywords.' . $defaultLanguage->id] = 'required|string|max:1024';
            $data ['title.' . $defaultLanguage->id] = 'required|string|max:255';
            $data ['description.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data ['content.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data['category_id'] = 'required|numeric|exists:categories,id';
        }
        return $data;
    }
}
