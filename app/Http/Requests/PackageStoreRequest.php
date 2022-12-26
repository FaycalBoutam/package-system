<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageStoreRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'status' => 'required|string|max:255',
            'note' => 'min:2',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Please assign the package to an apartment.',
            'user_id.integer' => 'The data is not an intiger.',
            'status.required' => 'Please select a status for the package.',
        ];
    }

}
