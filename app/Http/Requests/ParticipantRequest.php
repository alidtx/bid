<?php

namespace App\Http\Requests;

use App\Rules\MsisdnRule;
use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
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

            'bank_name' => ['required'],
            'address' => ['nullable', 'max:500'],
            'designation' => ['nullable', 'max:500'],
            'gender' => ['nullable', 'in:MALE,FEMALE'],
            'status' => ['nullable', 'in:0,1'],
            'image' => ['nullable', 'file', 'mimes:jpg,png'],
            // 'myDateRange' => ['nullable'],
            'from_date' => ['required'],
            'to_date' => ['required'],
            // 'voting_start_date_time' => ['date'],
            // 'voting_end_date_time' => ['date']
        ];

        if ($this->method() == 'POST') {

            $rules += [
                'name' => ['required', 'unique:participants,name'],
                'msisdn' => ['nullable', 'unique:participants,msisdn', 'max:15', new MsisdnRule],
                'email' => ['nullable', 'unique:participants,email', 'max:150', 'email'],
            ];
        }

        if ($this->method() == 'PUT' && $this->id) {

            $rules += [
                'name' => ['required', 'unique:participants,name,' . $this->id],
                'msisdn' => ['nullable', 'unique:participants,msisdn,' . $this->id, 'max:15', new MsisdnRule],
                'email' => ['nullable', 'unique:participants,email,' . $this->id, 'max:150', 'email'],

            ];
        }

//   dd($rules);
        return $rules;
    }
}
