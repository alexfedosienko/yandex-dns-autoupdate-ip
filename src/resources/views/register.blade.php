@extends('layouts.login')
@section('title', 'Регистрация')
@section('content')
  <div class="page page-center">
    <div class="container-tight py-4">
      <form class="card card-md" action="{{ route('register') }}" method="POST" autocomplete="off">
        @csrf
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Регистрация</h2>

          @if ($errors->any())
          <div class="alert alert-danger" role="alert">
            <h4 class="alert-title">Ошибка</h4>
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
          @endif
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="mail@mail.com" placeholder="Email">
          </div>
          <div class="mb-3">
            <label class="form-label">Пароль</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control" value="" placeholder="Пароль" autocomplete="off">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Повтор пароля</label>
            <div class="input-group">
              <input type="password" name="password2" class="form-control" value="" placeholder="Повтор пароля" autocomplete="off">
            </div>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
          </div>
        </div>
      </form>
      <div class="text-center text-muted mt-3">
        <a href="{{ route('login') }}">Войти</a>
      </div>
    </div>
  </div>
@stop
