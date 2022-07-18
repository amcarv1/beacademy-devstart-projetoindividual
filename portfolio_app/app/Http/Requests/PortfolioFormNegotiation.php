<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioFormNegotiation extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'quantity' =>  'required|numeric|min:1|',
            'value' =>  'required|numeric|min:1',
            'created_at' => 'required|date',
        ];
    }
}
