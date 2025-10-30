<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->isMethod('POST')) {
            return [
                'event_id' => 'required|exists:events,_id'
            ];
        }

        return [
            'status' => 'required|in:approved,rejected,cancelled'
        ];
    }
}