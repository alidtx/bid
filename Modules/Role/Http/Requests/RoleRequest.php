<?php

namespace Modules\Role\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        if ($this->method() == 'POST') {
            $rules += [
                'name' => ['required', 'unique:roles,name', 'max:255', 'not_in:'.RoleEnum::SUPERADMIN.','.RoleEnum::ADMIN],
                'permission' => ['required'],
            ];
        }

        if ($this->method() == 'PUT' && $this->id) {
            $rules += [
                'name' => ['required', 'unique:roles,name,'.$this->id, 'max:255', 'not_in:'.RoleEnum::SUPERADMIN.','.RoleEnum::ADMIN],
                'permission' => ['nullable'],
            ];
        }


        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
