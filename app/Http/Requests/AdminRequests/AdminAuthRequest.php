<?php

namespace App\Http\Requests\AdminRequests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use PHPUnit\TextUI\XmlConfiguration\ValidationResult;

class AdminAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|exists:admins,email',
            'password' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('الايميل'),
            'password' => __('الباس ورد'),
        ];
    }
}