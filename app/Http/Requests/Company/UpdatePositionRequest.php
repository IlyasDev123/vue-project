<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePositionRequest extends FormRequest
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
            'profession_id' => 'required|integer',
            'salary_id' => 'required|integer',
            'experience_id' => 'required|integer',
            'state_id' => 'required|integer',
            'position_id' => 'required'
        ];
    }
}