@extends('layouts/contentNavbarLayout')

@section('title', 'Add Project')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
@livewireStyles

@endsection
@if(session('success'))
<div style="  position: -webkit-sticky; position: sticky; top: 0; float: right;" class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1500">
  {{-- <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"> --}}
  <div class="toast-header">
    <i class='bx bx-bell me-2'></i>
    <div class="me-auto fw-semibold">Success</div>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
   {{ @session('success') }}  
  </div>
</div>

@endif
@section('content')
@livewireScripts
<a href="/roles" ><button type="button" class="btn btn-primary" style="float: right">←Back To Users</button></a>

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Users /</span> New User
</h4>

<div class="row">
  <div class="col-md-12">
    {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Connections</a></li>
    </ul> --}}
    <div class="card mb-4">
      <h5 class="card-header">User Capture Form</h5>
      <!-- Account -->
      {{-- <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Project Images</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>

            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
          </div>
        </div>
      </div> --}}
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="" action="{{ url('/register') }}" method="POST" >
          @csrf



          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Staff Name</label>
              <input class="form-control {{ $errors->has('name') ? 'error' : '' }}" type="text" id="name" name="name" autofocus placeholder="Staff Name"/>
            <!-- Error -->
        @if ($errors->has('name'))
        <div class="error">
            {{ $errors->first('name') }}
        </div>
        @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="username" class="form-label">Username</label>
              <input class="form-control {{ $errors->has('username') ? 'error' : '' }}" type="text" id="username" name="username" placeholder="Username"/>
            <!-- Error -->
        @if ($errors->has('username'))
        <div class="error">
            {{ $errors->first('username') }}
        </div>
        @endif
            </div>


            <div class="mb-3 col-md-6">
              <label for="username" class="form-label">Email</label>
              <input class="form-control {{ $errors->has('password') ? 'error' : '' }}" type="text" id="email" name="email" placeholder="Email"/>
            <!-- Error -->
        @if ($errors->has('email'))
        <div class="error">
            {{ $errors->first('email') }}
        </div>
        @endif
            </div>

            <div class="mb-3 col-md-6">
              <label for="password" class="form-label">Password</label>
              <input class="form-control {{ $errors->has('password') ? 'error' : '' }}" type="text" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
            <!-- Error -->
        @if ($errors->has('password'))
        <div class="error">
            {{ $errors->first('password') }}
        </div>
        @endif
            </div>
           
            {{-- {{$items = App\Models\Role::pluck('id', 'role_name');}} --}}
            
  

            <div class="mb-3 col-md-6">
              <label class="form-label" for="country">Role</label>
              
              <select id="id" class="select2 form-select">
                <option value="">Select</option>
                @foreach($items as $item)
                <option value="{{$item->id}}">{{$item->role_name}}</option>
                @endforeach
              </select>
              
            </div>
            
            {{-- <div class="mb-3 col-md-6">
              <label for="language" class="form-label">Language</label>
              <select id="language" class="select2 form-select">
                <option value="">Select Language</option>
                <option value="en">English</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="pt">Portuguese</option>
              </select>
            </div> --}}
            {{-- <div class="mb-3 col-md-6">
              <label for="timeZones" class="form-label">Timezone</label>
              <select id="timeZones" class="select2 form-select">
                <option value="">Select Timezone</option>
                <option value="-12">(GMT-12:00) International Date Line West</option>
                <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                <option value="-10">(GMT-10:00) Hawaii</option>
                <option value="-9">(GMT-09:00) Alaska</option>
                <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                <option value="-7">(GMT-07:00) Arizona</option>
                <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                <option value="-6">(GMT-06:00) Central America</option>
                <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                <option value="-6">(GMT-06:00) Saskatchewan</option>
                <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                <option value="-5">(GMT-05:00) Indiana (East)</option>
                <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                <option value="-4">(GMT-04:00) Caracas, La Paz</option>
              </select>
            </div> --}}
            {{-- <div class="mb-3 col-md-6">
              <label for="currency" class="form-label">Currency</label>
              <select id="currency" class="select2 form-select">
                <option value="">Select Currency</option>
                <option value="usd">USD</option>
                <option value="euro">Euro</option>
                <option value="pound">Pound</option>
                <option value="bitcoin">Bitcoin</option>
              </select>
            </div> --}}
          </div>
          {{-- <div>
            <button wire:click="submit">Checkout</button>
         
            <div wire:loading.delay.long>
                Processing Payment...
            </div>
        </div> --}}


          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>

  </div>
</div>
@endsection
