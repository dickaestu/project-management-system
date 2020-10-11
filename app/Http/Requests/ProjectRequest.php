<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'project_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:7000',
            'project_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'file_name' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'project_name.required' => 'Project Name is Required',
            'client_name.required' => 'Client Name is Required',
            'description.required' => 'Description is Required',
            'start.required' => 'Project Start is Required',
            'end.required' => 'Project End is Required',
            'project_logo.image' => 'Project Logo must be an image',
            'project_logo.max' => 'Maximum size 7 MB',
        ];
    }
}
