<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'attachment.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf',
            'tags' => 'nullable',
            'permission_status' => 'required|integer',
        ];
    }

    public function messages(){

        return [
            'title.required' => 'Post title is required.',
            'description.required' => 'Post details are requried.',
            'attachment.*.file' => 'Post attachment must be a valid file.',
            'attachment.*.mime' => 'Please provide allowed file types(jpeg,png,jpg,gif,pdf).',
            'permission_status.required' => 'Post status is required.',
            'permission_status.integer' => 'Please prvoide valid post status type.',
        ];
    }
}
