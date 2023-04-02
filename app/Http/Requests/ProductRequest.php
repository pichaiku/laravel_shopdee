<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $custID = $this->route('id');        
        return [            
            'productName' => 'string|required|max:200|unique:product,productName,'.$productID.',productID',
            'productDetail' => 'string|max:500',
            'price' => 'float|required|max:9999999999',
            'quantity' => 'int|required|max:99999',
            'imageFile' => 'string|required|max:100',
            'typeID' => 'int|required|max:999',
        ];
    }//`productDetail`, `price`, `quantity`, `imageFile`, `typeID`

    public function messages()
    {        
        return [            
            'productName.required' =>'กรุณาระบุชื่อสินค้า',
            'productName.unique' =>'ชื่อสินค้านี้มีอยู่แล้ว',
            'price.required' =>'กรุณาระบุราคาสินค้า',
            'quantity.required' =>'กรุณาระบุจำนวน',
            'imageFile.required' =>'กรุณาระบุรูปสินค้า',
            'typeID.required' =>'กรุณาระบุประเภทสินค้า',
        ];        
    }
}
