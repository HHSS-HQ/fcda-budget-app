@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection


@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">

      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            {{-- <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])</span>
              <span class="app-brand-text demo text-body fw-bolder">{{config('variables.templateName')}}</span>
            </a> --}}
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <img src="{{asset('assets/img/FCT-logo.png')}}" alt="" style=" width:20%;" />
              <span class="app-brand-text demo  fw-bold ms-2 " style="text-transform:none;">OpenBudgetCT</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Register on the app to get started</h4>
          <p class="mb-4">We'll request a few details. Once registered, an admin will have to approve you.</p>
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
          {{-- <form id="formAuthentication" class="mb-3" action="{{url('/')}}" method="GET"> --}}
            {{-- <form id="formAuthentication" class="mb-3" action="{{ route('register.custom') }}" method="POST"> --}}
              <form id="formAuthentication" class="mb-3" action="{{ route('register.perform') }}" method="POST">
                @csrf
                {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

                <div class="mb-3">
                  <label for="username" class="form-label">Department</label>
                  <select id="cylinder_left" class="form-control {{ $errors->has('department_id') ? 'error' : '' }}"
                    name="department_id">
                    <option value="">Select Department...</option>
                    {{$departments = App\Models\Department::select('department_name', 'id')->get();}}
                    @forelse($departments as $item)
                    <option value="{{$item->id}}">{{$item->department_name}}</option>
                    @empty
                    @endforelse
                  </select>

                  <!-- Error -->
                  @if ($errors->has('username'))
                  <div class="error">
                    {{ $errors->first('username') }}
                  </div>
                  @endif
                </div>

                <div class="mb-3">
                  <input type="hidden" value="1" name="role_id" placeholder="Enter your Fullname">
                  <div class="mb-3">
                    <label for="username" class="form-label">Fullname</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" id="name"
                      name="name" placeholder="Enter your Fullname" autofocus>
                    <!-- Error -->
                    @if ($errors->has('name'))
                    <div class="error">
                      {{ $errors->first('name') }}
                    </div>
                    @endif
                  </div>

                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control {{ $errors->has('username') ? 'error' : '' }}" id="username"
                      name="username" placeholder="Enter your username">
                    <!-- Error -->
                    @if ($errors->has('username'))
                    <div class="error">
                      {{ $errors->first('username') }}
                    </div>
                    @endif
                  </div>

                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control {{ $errors->has('email') ? 'error' : '' }}" id="email"
                      name="email" placeholder="Enter your email">
                    <!-- Error -->
                    @if ($errors->has('email'))
                    <div class="error">
                      {{ $errors->first('email') }}
                    </div>
                    @endif
                  </div>

                  <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password"
                        class="form-control {{ $errors->has('password') ? 'error' : '' }}" name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
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
                      <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                      <label class="form-check-label" for="terms-conditions">
                        I agree to
                        <a href="javascript:void(0);">privacy policy & terms</a>
                      </label>
                    </div>
                  </div> --}}
                  <button class="btn btn-primary d-grid w-100">
                    Sign up
                  </button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="{{url('/login')}}">
                  <span>Sign in instead</span>
                </a>
              </p>
        </div>
      </div>
    </div>
    <!-- Register Card -->
  </div>
</div>
</div>
@endsection