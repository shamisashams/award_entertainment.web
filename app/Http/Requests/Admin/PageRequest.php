<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        $defaultLanguage = Language::where('default', true)->firstOrFail();

        $data = [
        ];
        if ($this->method() !== 'GET') {
            $data ['title.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data ['content_1.' . $defaultLanguage->id] = 'nullable|string';
            $data ['content_2.' . $defaultLanguage->id] = 'nullable|string';

        }
        return $data;
    }
}
