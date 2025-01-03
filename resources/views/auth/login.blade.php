@extends('template.loginTemplate')
@section('title', 'Login - Controle de medicamentos')

@section('content')
<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

    <div class="d-flex justify-content-center py-4">
      <a href="index.html" class="logo d-flex align-items-center w-auto">
        <img src="assets/img/logo.png" alt="">
      </a>
    </div><!-- End Logo -->

    <div class="card mb-3">

      <div class="card-body">

        <div class="pt-4 pb-2">
          <h5 class="card-title text-center pb-0 fs-4">Login na sua conta</h5>
          <p class="text-center small">Insira seu usuário e senha</p>
        </div>

        <form class="row g-3" action="{{ route('login') }}" method="POST">
          @csrf
          <div class="col-12">
            <label for="yourUsername" class="form-label">Usuário</label>
            <div class="input-group has-validation">
              <span class="input-group-text" id="inputGroupPrepend">@</span>
              <input type="text" name="username" class="form-control" id="yourUsername">
            </div>
              @error('username')
              <span>{{ $message }}</span>
              @enderror
          </div>

          <div class="col-12">
            <label for="yourPassword" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" id="yourPassword">
            @error('password')
            <span>{{ $message }}</span>
            @enderror
          </div>
          
          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
              <label class="form-check-label" for="rememberMe">Lembrar-me</label>
            </div>
          </div>
          <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Login</button>
          </div>
          @if($error = session()->get('messagem'))
          <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        </form>

      </div>
    </div>

  </div>
  @endsection