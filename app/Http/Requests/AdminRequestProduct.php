<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequestProduct extends FormRequest
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
            'pro_name'          => 'required|max:190|min:3|unique:products,pro_name,'.$this->id,
            'pro_price'         =>'required',
            'pro_description'   =>'required',
            'pro_content'       =>'required',
            'pro_category_id'       =>'required',
        ];
    }

    public function messages()
    {
        return [
            'pro_name.required'   => 'Dữ liệu không được để trống',
            'pro_name.unique'     => 'Dữ liệu đã tồn tại',
            'pro_name.max'        => 'Dữ liệu không quá 190 ký tự',
            'pro_name.min'        => 'Dữ liệu phải nhiều hơn 3 ký tự'
        ];
    }
}
