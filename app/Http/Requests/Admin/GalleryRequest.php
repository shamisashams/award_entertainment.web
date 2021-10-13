<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            $data ['status.' . $defaultLanguage->id] = 'nullable|boolean';
            $data ['video_link.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data ['title.' . $defaultLanguage->id] = 'required|string|max:255';
            $data ['description.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data ['short_description.' . $defaultLanguage->id] = 'nullable|string|max:255';
            $data ['content.' . $defaultLanguage->id] = 'required|string';
            $data ['slug.' . $defaultLanguage->id] = 'required|string|max:255';

        }
        return $data;
    }
}
