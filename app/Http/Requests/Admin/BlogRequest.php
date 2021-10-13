<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
        $defaultLanguage = Language::where('default', true)->firstOrFail();

        $data = [
        ];
        if ($this->method() !== 'GET') {
            $data ['status.' . $defaultLanguage->id] = 'nullable|boolean';
            $data ['title.' . $defaultLanguage->id] = 'required|string|max:255';
            $data ['description.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data ['short_description.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data ['content.' . $defaultLanguage->id] = 'required|string';
            $data ['slug.' . $defaultLanguage->id] = 'required|string|max:255';
            $data ['city.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data ['country.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data['images'] = 'max:1';
        }
        return $data;
    }

    public function messages()
    {
        return [
            'images.max' => __('client.file_max_count'),
        ];
    }
}
