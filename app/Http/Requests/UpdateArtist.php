<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtist extends FormRequest
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
        $id = $this->route()->parameters['artist'];

        return [
            'name' => 'required|unique:genres,name,' . (int)$id . '|min:2',
            'avatar' => 'image|max:1024',
            'year_active' => 'required|numeric|min:0',
            'info' => 'required',
            'genres.*' => 'numeric|exists:genres,id',
        ];
    }
}
