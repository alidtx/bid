<?php

namespace Modules\User\Http\Requests;

use App\Rules\MsisdnRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'status' => ['required', 'in:0,1'],
            'role_id' => ['required', 'exists:roles,id', 'not_in:1'],
        ];

        if ($this->method() == 'POST') {
            $rules += [
                'email' => ['required', 'email', 'unique:users,email', 'max:255'],
                'msisdn' => ['nullable', 'unique:users,msisdn', 'max:15', new MsisdnRule],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ];
        }

        if ($this->method() == 'PUT' && $this->id) {
            $rules += [
                'email' => ['required', 'email', 'unique:users,email,'.$this->id, 'max:255'],
                'msisdn' => ['nullable', 'unique:users,msisdn,'.$this->id, 'max:15', new MsisdnRule],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],

            ];
        }


        return $rules;
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            
            'msisdn.required' => 'Mobile Number is required!',
            'msisdn.unique' => 'Mobile Number is already taken!',
    
        ];
    }
}
