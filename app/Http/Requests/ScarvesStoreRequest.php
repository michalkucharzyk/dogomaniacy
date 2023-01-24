<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ScarvesStoreRequest extends FormRequest
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
        $mainImage =  'required|mimes:png,jpg,jpeg,|max:15360';
        $name = 'required|unique:scarves|max:55';
        if ($this->isMethod('PUT')) {
            $mainImage =  'nullable|mimes:png,jpg,jpeg,|max:15360';
            $name =  'required|unique:scarves,name,'.request()->route('scarf')->id.'|max:55';
        }

        return [
            'name' => $name,
            'description' => 'required',
            'public' => 'nullable',
            'position' => 'nullable|numeric|min:1|max:99999',
            'main_image' => $mainImage,
            'attachment' => 'max:5',
            'attachment.*' => 'nullable|mimes:png,jpg,jpeg,|max:15360'
        ];
    }
}