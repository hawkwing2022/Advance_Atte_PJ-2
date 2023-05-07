<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if($this->path() == 'registration'){
            return true;
        // } else {
        //     return false;
        // }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required | string | max:255',
            'email' => 'required | string | email | max:255 | unique:users',
            'password' => [ 'required | confirmed', Rules\Password::defaults() ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '文字列で入力してください',
            'name.max:255' => '半角255文字(全角127)以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => '文字列で入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'email.max:255' => '半角255文字以内で入力してください',
            'email.unique:users' => '登録済みのメールアドレスです',
            'password.required' => 'パスワードを入力してください',
            'password.confirmed' => '確認パスワードと一致しません',
        ];
    }
}
