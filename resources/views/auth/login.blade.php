@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
  <h2 class="mb-4 text-center">Login</h2>

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <form method="POST" action="{{ route('login.submit') }}">
    @csrf
    <div class="mb-3">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" required autofocus>
    </div>

    <div class="mb-3">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>

  <p class="mt-3 text-center">
    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
  </p>
</div>
@endsection
