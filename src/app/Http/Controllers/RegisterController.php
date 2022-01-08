<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{

  public function index()
  {
    return view('register');
  }

  public function save(RegisterRequest $request)
  {
    if (Auth::check()) {
      return redirect(route('dashboard'));
    }

    $inputFields = $request->only(['email', 'password', 'password2',]);

    if (User::where('email', $inputFields['email'])->exists()) {
      return redirect(route('register'))->withErrors([
        'error' => 'Такой пользователь уже зарегистрирован'
      ]);
    }

    $user = User::create($inputFields);
    if ($user) {
      Auth::login($user);
      return redirect(route('dashboard'));
    }

    return redirect(route('login'))->withErrors([
      'error' => 'Ошибка при сохранении пользователя'
    ]);
  }
}
