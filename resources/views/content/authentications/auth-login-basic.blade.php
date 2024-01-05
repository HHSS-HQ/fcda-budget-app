@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <img src="{{asset('assets/img/FCT-logo.png')}}" alt="" style=" width:20%;" />
              <span class="app-brand-text demo  fw-bold ms-2 " style="text-transform:none;">OpenBudgetCT</span>
            </a>


          </div>
          <!-- /Logo -->

          <h4 class="mb-2">Welcome back! 👋</h4>
          <p class="mb-4">Please sign-in to your account</p>
          @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{ @session('success') }}  
          </div>
          @endif
          @if(session('error'))
          <div class="alert alert-danger" role="alert">
            {{ @session('error') }}  
          </div>
          @endif
          <form id="formAuthentication" class="mb-3" action="" action="{{route('login.perform')}}" method="POST">
            @csrf
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}
            <div class="mb-3">
              <label for="email" class="form-label">Email or Username</label>
              <input type="text" class="form-control {{ $errors->has('username') ? 'error' : '' }}" id="username" name="username" placeholder="Enter your email or username" autofocus>
                       <!-- Error -->
                       @if ($errors->has('username'))
                       <div class="error">
                           {{ $errors->first('username') }}
                       </div>
                       @endif
                           </div>

            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="{{url('auth/forgot-password-basic')}}">
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control {{ $errors->has('password') ? 'error' : '' }}" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
                                   <!-- Error -->
        @if ($errors->has('password'))
        <div class="error">
            {{ $errors->first('password') }}
        </div>
        @endif
            </div>
            {{-- <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">
                  Remember Me
                </label>
              </div>
            </div> --}}
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{ route('register.perform') }}">
              <span>Create an account</span>
            </a>
          </p>
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>
@endsection
