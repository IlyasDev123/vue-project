<?php

namespace App\Http\Requests\User;

use App\Utlities\Constants;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            // 'first_name' => 'required|regex:/^[\pL\s]+$/u|max:50',
            // 'last_name' => 'nullable|regex:/^[\pL\s]+$/u|max:50',
            // 'type' => 'required|integer',
            // 'profession_id' => 'required|integer',
            // 'salary_id' => 'required|integer',
            // 'experience_id' => 'required|integer',
            'state_id' => 'required|integer',
            'prefer_work_location_id' => 'required|integer',
            'id' => 'required_if:type, == , ' . Constants::USER_TYPE_TALENT . '|integer',
            'employer_selection_preference_id' => 'required_if:type, == , ' . Constants::USER_TYPE_TALENT . '|integer',
            'coworker_review_id' => 'required_if:type, ==, ' . Constants::USER_TYPE_TALENT . '|integer',
            'hobby_id' => 'required_if:type, ==,' . Constants::USER_TYPE_TALENT . '|integer',
            // 'cv' => 'required_if:type, ==,' . Constants::USER_TYPE_TALENT . '|mimes:pdf',
            'company_name' => 'required_if:type, ==,' . Constants::USER_TYPE_COMPANY . '|string',
            // 'team_loveable_aspect_id' => 'required_if:type, ==,' . Constants::USER_TYPE_COMPANY . '|integer',
            'position_id' => 'required_if:type, ==,' . Constants::USER_TYPE_COMPANY . '|integer',
        ];
    }
}