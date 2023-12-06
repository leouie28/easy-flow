<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'user_id' => 'required|string',
            'fund_id' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|in:fund,income,expense,transfer',
            'form' => 'required|string',
            'note' => 'nullable|string',
            'date' => 'required|date',
        ];
    }
}
