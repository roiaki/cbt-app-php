@extends('layouts.app')

@section('content')
<?php
  $locale = App::currentLocale();
  $json_array = json_encode($locale);
?>
<script>
	let locale = <?php echo $json_array; ?>
</script>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="glasscard">
        
        <!-- <div class="card-header">{{ __('auth.Register') }}</div> -->

        <div class="card-body">
          <div><h3 class="mb-5" style="text-align: center;">{{ __('auth.Register') }}</h3></div>
          <form method="POST" action="{{ route('signup.get') }}">
            @csrf

            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth.Name') }}</label>

              <div class="col-md-6">
                <input id="name" 
                       type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       name="name" 
                       value="{{ old('name') }}"  
                       autocomplete="name" 
                       autofocus
                       onblur="blurRegister(locale)">
                
                <!-- フロントバリデーションエラーメッセージ -->
                <div class="err-msg-name01 mt-3"></div>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" 
                       type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" 
                       value="{{ old('email') }}"
                       autocomplete="email"
                       onblur="blurRegister(locale)">
                
                <!-- フロントバリデーションエラーメッセージ -->
                <div class="err-msg-name02 mt-3"></div>

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth.Password') }}</label>

              <div class="col-md-6">
                <input id="password" 
                       type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password"  
                       autocomplete="new-password"
                       onblur="blurRegister(locale)">
                
                <!-- フロントバリデーションエラーメッセージ -->
                <div class="err-msg-name03 mt-3"></div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('auth.Confirm Password') }}</label>

              <div class="col-md-6">
                <input id="password-confirm" 
                       type="password" 
                       class="form-control" 
                       name="password_confirmation"  
                       autocomplete="new-password"
                       onblur="blurRegister(locale)">
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button id="submit-btn" type="submit" class="btn btn-primary mt-3">
                  {{ __('auth.Register') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection