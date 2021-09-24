<?php
/**
 *  app/Http/Requests/Admin/AnswerRequest.php
 *
 * Date-Time: 09.06.21
 * Time: 11:29
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AnswerRequest
 * @package App\Http\Requests\Admin
 */
class AnswerRequest extends FormRequest
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
            'feature' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
        ];

        if ($this->method !== 'GET') {
            $data['title.' . $defaultLanguage->id] = 'required|string|max:255';
            $data['feature_id'] = 'required|numeric|exists:features,id';
        }
        return $data;
    }
}
