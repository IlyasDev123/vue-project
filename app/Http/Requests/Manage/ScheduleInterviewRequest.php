<?php

namespace App\Http\Requests\Manage;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleInterviewRequest extends FormRequest
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
            'description' => 'nullable',
            'datetime' => 'required',
            'id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'datetime.required' => 'Interview date & time is requried',
            'id.required' => 'Request id is required.',
            'id.integer' => 'Request id must be an integer value',
        ];
    }
}
