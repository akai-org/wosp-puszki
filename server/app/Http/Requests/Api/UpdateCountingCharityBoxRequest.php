<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

class UpdateCountingCharityBoxRequest extends BoxCharityBoxRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(
        // parent::rules(), dont merge - we dont need box_id
            [],
            [
                'count_1gr' => 'required|integer|between:0,15000',
                'count_2gr' => 'required|integer|between:0,15000',
                'count_5gr' => 'required|integer|between:0,10000',
                'count_10gr' => 'required|integer|between:0,10000',
                'count_20gr' => 'required|integer|between:0,10000',
                'count_50gr' => 'required|integer|between:0,10000',
                'count_1zl' => 'required|integer|between:0,10000',
                'count_2zl' => 'required|integer|between:0,10000',
                'count_5zl' => 'required|integer|between:0,10000',
                'count_10zl' => 'required|integer|between:0,10000',
                'count_20zl' => 'required|integer|between:0,10000',
                'count_50zl' => 'required|integer|between:0,10000',
                'count_100zl' => 'required|integer|between:0,10000',
                'count_200zl' => 'required|integer|between:0,10000',
                'count_500zl' => 'required|integer|between:0,10000',
                // Waluty obce
                'amount_EUR' => 'required|numeric|between:0,10000',
                'amount_USD' => 'required|numeric|between:0,10000',
                'amount_GBP' => 'required|numeric|between:0,10000',
                'comment' => '',
            ]
        );
    }
}
