<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

  public function rules()
  {
    return [
      'email' => 'required|email',
      'password' => 'required',
      'password2' => 'required|same:password'
    ];
  }

  public function messages()
  {
    return [
      'email.required' => 'Email должен быть заполнен',
      'password.required' => 'Пароль должен быть заполнен',
      'password2.required' => 'Повтор пароля должен быть заполнен',
      'password2.same' => 'Пароли не совпадают',
    ];
  }
}
