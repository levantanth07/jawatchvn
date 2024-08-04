<?php

namespace App\Http\Requests\Campaign;

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
        $id = (int)$this->request->get('id');
        return [
            'name' => 'required|unique:campaigns,name,'.$id,
            'image' => 'mimes:jpg,jpeg,png',
        ];
    }
}
