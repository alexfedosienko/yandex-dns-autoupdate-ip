<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

  public function index(Request $request)
  {
    if (Auth::check()) {
      return redirect(route('dashboard'));
    }
    return view('login');
  }

  public function login(Request $request)
  {
    $formFields = $request->only(['email', 'password']);

    if (Auth::attempt($formFields)) {
      return redirect()->intended(route('dashboard'));
    }
    return redirect(route('login'))->withErrors(['dont_login' => 'Не удалось авторизоваться']);
  }
}
