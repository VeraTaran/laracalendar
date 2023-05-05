<?php

namespace App\Http\Requests\Admin\V1\Pages\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendar extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => 'required|integer',
            'date' => 'required',
        ];
    }
    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        //Add your code for manipulation with request data here
        //$sanitized['user_id'] = 1;

        return $sanitized;
    }
}
