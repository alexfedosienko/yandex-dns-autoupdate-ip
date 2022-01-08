@extends('layouts.login')
@section('title', 'Авторизация')
@section('content')
  <div class="page page-center">
    <div class="container-tight py-4">
      <form class="card card-md" action="{{ route('login') }}" method="POST" autocomplete="off">
        @csrf
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Авторизация</h2>
          @error('dont_login')
          <div class="alert alert-danger" role="alert">
            <h4 class="alert-title">{{ $message }}</h4>
          </div>
          @enderror
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="" placeholder="Email">
          </div>
          <div class="mb-2">
            <label class="form-label">Пароль</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control" value="" placeholder="Пароль" autocomplete="off">
            </div>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Войти</button>
          </div>
        </div>
      </form>
      <div class="text-center text-muted mt-3">
        <a href="{{ route('register') }}">Регистрация</a>
      </div>
    </div>
  </div>
@stop
