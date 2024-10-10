<?php 
    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ProductRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'name' => 'required | string | max:50',
                'description' => 'required',
                'price' => 'required | integer',
                'previousPrice' => 'integer',
                'sub_category_id' => 'required | integer',
                'category_id' => 'required | integer'
            ];
        }
    }