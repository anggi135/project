@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="height: 90vh;">
  <div class="card p-4 shadow-lg" 
       style="width: 400px; background: rgba(255,255,255,0.08); backdrop-filter: blur(6px); border:1px solid rgba(255,255,255,0.15);">
    
    <h3 class="text-center mb-3 text-white">Register</h3>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
      @csrf

      <div class="mb-3">
        <label class="text-white">Nama</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
      </div>

      <div class="mb-3">
        <label class="text-white">Email</label>
        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
      </div>

      <div class="mb-3">
        <label class="text-white">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="text-white">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Daftar</button>
    </form>

    <p class="mt-3 text-center text-white">
      Sudah punya akun?
      <a href="{{ route('login') }}" class="text-warning">Login di sini</a>
    </p>

  </div>
</div>

@endsection
