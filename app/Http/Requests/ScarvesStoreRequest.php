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
        $mainImage =  'required|mimes:png,jpg,jpeg,|max:8096';
        $name = 'required|unique:scarves|max:55';
        if ($this->isMethod('PUT')) {
            $mainImage =  'nullable|mimes:png,jpg,jpeg,|max:8096';
            $name =  'required|unique:scarves,name,'.request()->route('scarf')->id.'|max:55';
        }

        return [
            'name' => $name,
            'description' => 'required',
            'public' => 'nullable',
            'main_image' => $mainImage,
            'attachment' => 'max:5',
            'attachment.*' => 'nullable|mimes:png,jpg,jpeg,|max:8096'
        ];
    }
}