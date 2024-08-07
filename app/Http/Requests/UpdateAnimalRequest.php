<?php

namespace App\Http\Requests;

use App\Models\Animal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAnimalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('animal_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:animals,title,' . request()->route('animal')->id,
            ],
            'breed_id' => [
                'required',
                'integer',
            ],
            'pet_type' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
