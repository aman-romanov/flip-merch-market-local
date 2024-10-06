<?php 
    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ProductRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'name' => 'sometimes | string | max:50',
                'description' => 'sometimes',
                'price' => 'sometimes | integer',
                'previousPrice' => 'integer',
                'sub_category_id' => 'sometimes | integer'
            ];
        }
    }