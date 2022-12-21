<nav class="navbar navbar-expand-sm navbar-light bg-light">
  <a class="navbar-brand font-weight-bold ml-5 beauty" href="/">CBT APP</a>
  <!-- 横幅が狭い時に出るハンバーガーボタン -->
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="nav-bar">
    <ul class="navbar-nav ml-auto">

      @if(Auth::check())
      
        <div class="d-flex align-items-center mr-4 pt-1 text-black-50 font-weight-bold">
          <p clsss="text-primary">
            ID : {{ $id = Auth::user()->id; }} {{ __('messages.en_mr_ms') }}&nbsp;
            {{ $name = Auth::user()->name; }} {{ __('messages.ja_mr_ms') }} 
        </div>

        <li class="nav-item font-weight-bold">{!! link_to_route('users.info',  __('messages.info'), [], ['class' => 'nav-link']) !!}</li>
        <li class="nav-item font-weight-bold">{!! link_to_route('events', __('messages.event_list'), [], ['class' => 'nav-link']) !!}</li>
        <li class="nav-item font-weight-bold">{!! link_to_route('three_columns', __('messages.3col_list') , [], ['class' => 'nav-link']) !!}</li>
        <li class="nav-item font-weight-bold">{!! link_to_route('seven_columns', __('messages.7col_list'), [], ['class' => 'nav-link']) !!}</li>
        <li class="nav-item font-weight-bold mr-3">{!! link_to_route('solutions', __('messages.solution_list'), [], ['class' => 'nav-link']) !!}</li>

        <!-- 言語切り替え -->
        <li class="dropdown font-weight-bold pt-2 mr-3" id="nav-lang">
          <a href="#" class="dropdown-toggle text-black-50" data-toggle="dropdown" role="button">
            {{ Config::get('languages')[App::getLocale()] }}
            <span class="caret"></span>
          </a>
            <ul class="dropdown-menu bg-light" aria-labelledby="dropdownMenu1">
              @foreach (Config::get('languages') as $lang => $language)
              @if ($lang != App::getLocale())
              <li>
                <a class="text-black-50" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
              </li>
              @endif
              @endforeach
            </ul>
        </li>
        <!-- ここまで言語切り替え -->
        <!-- アカウントdropdwon -->
        <li class="dropdown font-weight-bold pt-2" id="nav-lang">
          <a href="#" class="dropdown-toggle text-black-50" data-toggle="dropdown">
            {{ __('messages.account') }}
            <span class="caret"></span></a>
          <ul class="dropdown-menu bg-light text-black-50" aria-labelledby="dropdownMenu1">
            <li>{!! link_to_route('users.profile', __('messages.profile'), [], ['class' => 'nav-link']) !!}</li>
            <li>{!! link_to_route('logout.get', __('messages.logout'), [], ['class' => 'nav-link']) !!}</li>
            <li>{!! link_to_route('users.delete_confirm', __('messages.withdrawal'), [], ['class' => 'nav-link']) !!}</li>
          </ul>
        </li>
        <!-- /アカウントdropdown -->
        
      @else
        <!-- ここから言語切り替え -->
        <li class="dropdown font-weight-bold pt-2" id="nav-lang">
          <a href="#" class="dropdown-toggle text-black-50" data-toggle="dropdown">
            {{ Config::get('languages')[App::getLocale()] }}
            <span class="caret"></span></a>
          <ul class="dropdown-menu bg-light text-black-50" aria-labelledby="dropdownMenu1">
            @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
            <li>
              <a class="text-black-50" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
            </li>
            @endif
            @endforeach
          </ul>
        </li>
        <!-- ここまで言語切り替え -->
        
        <li class="nav-item font-weight-bold">{!! link_to_route('top', 'TOP', [], ['class' => 'nav-link']) !!}</li>
        <li class="nav-item font-weight-bold">{!! link_to_route('login', __('auth.Login'), [], ['class' => 'nav-link']) !!}</li>
        <li class="nav-item font-weight-bold">{!! link_to_route('signup.get', __('auth.Register'), [], ['class' => 'nav-link']) !!}</li>

      @endif
    
    </ul>
  </div>
</nav>