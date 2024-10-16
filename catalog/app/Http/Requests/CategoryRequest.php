<?php 
    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class CategoryRequest extends FormRequest
    {
        public function rules(): array
        {
            return [
                'name' => 'sometimes | string | max:255'
            ];
        }
    }