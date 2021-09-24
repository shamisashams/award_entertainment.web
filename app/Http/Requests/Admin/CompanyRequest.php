<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            $data ['company_link'] = 'nullable|string|max:255';
            $data ['description.' . $defaultLanguage->id] = 'nullable|string|max:1000';

        }
        return $data;
    }
}
