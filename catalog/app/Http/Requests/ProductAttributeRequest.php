<?php 
    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ProductAttributeRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'color' => 'required | string | max:50',
                'size' => 'required | string',
                'price' => 'required | integer',
                'product_id' => 'required|integer',
                'sub_category_id' => 'required | integer'
            ];
        }
    }