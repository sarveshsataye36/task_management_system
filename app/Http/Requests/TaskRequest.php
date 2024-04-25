<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'task_name'=>'required',
            'task_details'=>'required',
            'task_user_id'=>'required',
            'task_project_id'=>'required',
            'task_status'=>'required',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'task_name.required' => 'Task name is required',
            'task_details.required' => 'Enter task details',
            'task_user_id.required' => 'Select Employee',
            'task_project_id.required' => 'Select Project',
            'task_status.required' => 'Select Status',
        ];
    }
}
