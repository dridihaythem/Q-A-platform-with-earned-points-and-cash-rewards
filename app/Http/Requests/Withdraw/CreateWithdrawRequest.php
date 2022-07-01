<?php

namespace App\Http\Requests\Withdraw;

use App\Rules\haveBalance;
use App\Rules\minAmountToWithdraw;
use Illuminate\Foundation\Http\FormRequest;

class CreateWithdrawRequest extends FormRequest
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
        return [
            'payment_method_id' => 'required|numeric|exists:payment_methods,id',
            'amount' => ['required', 'numeric', 'min:1', new haveBalance(), new minAmountToWithdraw()],
            'payment_details' => 'required'
        ];
    }
}
