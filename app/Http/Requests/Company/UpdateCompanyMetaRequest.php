<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyMetaRequest extends FormRequest
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
            'state_id' => 'required|integer',
            'prefer_work_location_id' => 'required|integer',
            'company_name' => 'required|string',
            'current_role' => 'required|string',
            'team_loveable_aspect_id' => 'required|integer',
        ];
    }
}
