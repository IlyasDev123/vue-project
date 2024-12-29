<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UploadProfileImage extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'avatar' => 'nullable|image|mimes:jpg,bmp,jpeg,png,svg,gif,webp|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'avatar.image' => 'Avatar must be an image type.',
            'avatar.mimes' => 'Allowed image formats are (jpg,bmp,jpeg,png,svg,gif,webp)',
            'avatar.max' => 'Maximum allowed profile size is 5MB'
        ];
    }
}
