<?php

namespace App\Http\Requests\Talent;

use Illuminate\Foundation\Http\FormRequest;

class AddSkillRequest extends FormRequest
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
            // 'state_id' => 'required|integer',
            // 'prefer_work_location_id' => 'required|integer',
            // 'employer_selection_preference_id' => 'required|integer',
            // 'coworker_review_id' => 'required|integer',
            // 'hobby_id' => 'required|integer',
        ];
    }
}