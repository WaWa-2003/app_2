<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // return [
        //     'name' => ['string', 'max:255'],
        //     'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        // ];

        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender' => ['required', 'in:male,female,other'],
            'date_of_birth' => ['required', 'date'],
            'phone_number' => ['required', 'string', 'max:15'],
            'currently_looking_job' => ['required', 'boolean'],
            'current_job_position' => ['nullable', 'string', 'max:255'],
            'expected_salary' => ['nullable', 'integer'],
            'resume_cv_name' => ['nullable', 'string', 'max:255'],
            'resume_cv_file_path' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
            'experience_year' => ['nullable', 'numeric', 'min:0'],
            'photo_path' => ['nullable', 'string', 'max:255'],
        ];
    }
}
