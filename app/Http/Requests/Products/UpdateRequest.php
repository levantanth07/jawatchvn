<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = $this->request->get('id');
        return [
            'name' => 'required|unique:products,name,'.$id,
            'image' => 'mimes:jpg,jpeg,png',
            'filenames.*' => 'mimes:jpg,jpeg,png'
        ];
    }
}
