<?php

namespace App\Http\Requests\Feedback;
use Illuminate\Foundation\Http\FormRequest;
class StorePromotion extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ];
    }
}
