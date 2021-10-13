<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlbum extends FormRequest
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
            'title' => 'required|min:2',
            'picture' => 'image|max:1024',
            'relate_date' => 'date',
            'info' => 'required',
            'genre_id' => 'numeric|exists:genres,id',
            'artist_id' => 'numeric|exists:artists,id',
            'tracks.*' => 'numeric|exists:tracks,id',
        ];
    }
}
