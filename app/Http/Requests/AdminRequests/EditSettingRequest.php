<?php

namespace App\Http\Requests\AdminRequests;

use Illuminate\Foundation\Http\FormRequest;

class EditSettingRequest extends FormRequest
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
            'about_us' => "required|string|max:2500|nullable",
            'facebook' => "required|string|max:255|nullable",
            'twitter' => "required|string|max:255|nullable",
            'instagram' => "required|string|max:255|nullable",
            'terms' => "required|string|max:1000|nullable",
            'phone' => "required|string|max:255|nullable",
            'email' => "required|email|max:255|nullable",
        ];
    }

    public function attributes()
    {
        return [
            'about_us'  => __('معلومات عنا'),
            'facebook'  => __('الفيس بوك'),
            'twitter'  => __('التويتر'),
            'instagram'  => __('الانستجرام'),
            'terms'  => __('الشروط و الاحكام'),
            'phone'  => __('الهاتف'),
            'email'  => __('الايميل'),
        ];
    }
}