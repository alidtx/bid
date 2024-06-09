<?php

namespace App\Http\Requests;

use App\Rules\MsisdnRule;
use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
        $rules = [
            'name' => ['required'],
           
            'address' => ['nullable', 'max:500'],
            'designation' => ['nullable', 'max:500'],
            'gender' => ['nullable', 'in:MALE,FEMALE'],
            'status' => ['nullable', 'in:0,1'],
            'image' => ['nullable', 'file', 'mimes:jpg,png']
        ];

        if ($this->method() == 'POST') {
             
              $rules += [
                  'msisdn' => ['required', 'unique:doctors,msisdn', 'max:15', new MsisdnRule],
                  'email' => ['nullable', 'unique:doctors,email', 'max:150', 'email'],
                ];
            }
            
            if ($this->method() == 'PUT' && $this->id) {
         
            $rules += [
                'msisdn' => ['required', 'unique:doctors,msisdn,'.$this->id, 'max:15', new MsisdnRule],
                'email' => ['nullable', 'unique:doctors,email,'.$this->id, 'max:150', 'email'],

            ];
        }

//   dd($rules);
        return $rules;
    }
}
