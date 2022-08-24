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
    <div class="col-md-8">
      
      <div class="glasscard">
       
        <div class="card-body">
        <div><h3 class="mb-5" style="text-align: center;">{{ __('auth.Login') }}</h3></div>
          <form method="POST"
                id="form"
                action="{{ route('login') }}"
                onsubmit="return validationUser();">
            @csrf

            <!-- メール -->
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.E-Mail Address') }}</label>
              <div class="col-md-6">
                <input id="email" 
                       type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" 
                       value="{{ old('email') }}" 
                       autocomplete="email" 
                       onblur="blurEmailAndPassword(locale);">
                
                <!-- フロントバリデーションエラーメッセージ -->
                <div class="err-msg-name01 mt-3"></div>

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <!-- /メール -->

            <!--　パスワード -->
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth.Password') }}</label>

              <div class="col-md-6">
                <input id="password" 
                       type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password" 
                       autocomplete="current-password"
                       onblur="blurEmailAndPassword(locale);">

                <!-- フロントバリデーションエラーメッセージ -->
                <div class="err-msg-name02 mt-3"></div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <!--　/パスワード -->

            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    {{ __('auth.Remember Me') }}
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" 
                        class="btn btn-primary mt-3"
                        id="submit-btn">
                  {{ __('auth.Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection