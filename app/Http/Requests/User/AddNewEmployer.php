<?php

namespace App\Http\Requests\User;

use App\Utlities\Constants;
use Illuminate\Foundation\Http\FormRequest;

class AddNewEmployer extends FormRequest
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
            'first_name' => 'required|max:50',
            'last_name' => 'nullable|max:50',
            'email' => 'required_without:social_login_id|email|unique:users',
            // 'password' => 'required_without:social_login_id|min:8|max:16|string',
            // 'social_login_id' => 'required_without:password|string|nullable',
            // 'password' => 'required_without:social_login_id|min:8|max:16|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|confirmed',
            // 'social_login_type' => 'required_with:social_login_id',
            'type' => 'required|integer',
            'phone_no' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpg,bmp,jpeg,png,svg,gif,webp|max:5120',
            'company_name' => 'nullable|required_if:type, ==,' . Constants::USER_TYPE_COMPANY . '|string',
            // 'is_agree_with_terms_condition' => 'required|boolean',
            // 'profession_id' => 'required|integer',
            // 'salary_id' => 'required|integer',
            // 'experience_id' => 'required|integer',
            // 'state_id' => 'required|integer',
            // 'prefer_work_location_id' => 'required|integer',
            // 'employer_selection_preference_id' => 'required_if:type, == , ' . Constants::USER_TYPE_TALENT . '|integer',
            // 'coworker_review_id' => 'required_if:type, ==, ' . Constants::USER_TYPE_TALENT . '|integer',
            // 'hobby_id' => 'required_if:type, ==,' . Constants::USER_TYPE_TALENT . '|integer',
            // 'cv' => 'required_if:type, ==,' . Constants::USER_TYPE_TALENT . '|mimes:pdf',
            // 'team_loveable_aspect_id' => 'required_if:type, ==,' . Constants::USER_TYPE_COMPANY . '|integer',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.max' => 'First name allowed length is 50 characters.',
            'last_name.max' => 'Last name allowed length is 50 characters.',
            'email.required_without' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email already exists.',
            // 'password.required_without' => 'Password is required.',
            // 'password.min' => 'Password must be atleast 8 characters.',
            'type.required' => 'User type is required.',
            'type.integer' => 'User type must be integer value.',
            'avatar.image' => 'Avatar must be an image type.',
            'avatar.mimes' => 'Allowed image formats are (jpg,bmp,jpeg,png,svg,gif,webp)',
            'company_name.required_if' => 'Please provide company name.'
        ];
    }
}
