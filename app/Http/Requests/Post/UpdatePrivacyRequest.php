<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrivacyRequest extends FormRequest
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
            'post_id' => 'required|exists:posts,id',
            'permission_status' => 'required|integer',
        ];
    }

    public function messages(){

        return [
            'post_id.required' => 'Post id is required.',
            'post_id.exists' => 'Post does not exist.',
            'permission_status.required' => 'Post status is required.',
            'permission_status.integer' => 'Please prvoide valid post status type.',
        ];
    }
}
