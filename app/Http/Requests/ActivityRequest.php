<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ActivityRequest extends Request
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
            'name' => 'required',
            'is_public' => 'boolean',
            'description' => 'required',
            'start' => [ 'date', 'before:end' ],
            'end' => [ 'date', 'after:start' ],
            'subscription_start' => [ 'date', 'after:subscription_end' ],
            'subscription_end' => [ 'date', 'before:subscription_start' ],
        ];
    }
}
