<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class RefereCompanyToTalentRequest extends FormRequest
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
            'positionId' => 'required|integer',
            'companyId' => 'required|integer',
            'talentIds.*' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'positionId.required' => 'Position is required.',
            'positionId.integer' => 'Position must be integer data.',
            'companyId.required' => 'Compnay is required.',
            'companyId.integer' => 'Company must be integer data.',
            'talentIds.*.required' => 'Talent id is required.',
            'talentIds.*.integer' => 'Talent id must be integer value',
        ];
    }
}
