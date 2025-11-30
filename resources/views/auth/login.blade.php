@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="height: 90vh;">
  <div class="card p-4 shadow-lg" style="width: 380px; background: rgba(255,255,255,0.08); backdrop-filter: blur(6px); border:1px solid rgba(255,255,255,0.15);">
    
    <h3 class="text-center mb-3 text-white">Login</h3>

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
      @csrf

      <div class="mb-3">
        <label class="text-white">Email</label>
        <input type="email" name="email" class="form-control" required autofocus>
      </div>

      <div class="mb-3">
        <label class="text-white">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>

    </form>

    <p class="mt-3 text-center text-white">
      Belum punya akun?
      <a href="{{ route('register') }}" class="text-warning">Daftar di sini</a>
    </p>

  </div>
</div>

@endsection
