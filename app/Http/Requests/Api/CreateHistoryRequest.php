<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $client_key
 * @property string $value
 */
class CreateHistoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'client_key' => 'required|string|uuid',
            'value' => 'required|string'
        ];
    }
}
