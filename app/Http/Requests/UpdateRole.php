<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRole extends FormRequest
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
        $id = $this->route()->parameters['role'];

        return [
            'name' => 'required|unique:roles,name,' . $id . '|min:2',
            'display_name' => 'required|min:2',
            'description' => 'required|min:2',
        ];
    }
}
