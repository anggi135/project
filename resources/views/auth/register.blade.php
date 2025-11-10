@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
  <h2 class="mb-4 text-center">Register</h2>

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
      <label for="name">Nama</label>
      <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
    </div>

    <div class="mb-3">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
    </div>

    <div class="mb-3">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="password_confirmation">Konfirmasi Password</label>
      <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success w-100">Daftar</button>
  </form>
</div>
@endsection
