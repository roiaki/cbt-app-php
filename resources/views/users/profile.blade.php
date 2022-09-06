@extends('layouts.app')

@section('content')

<div class="glasscard row justify-content-center">
  
  <div class="col-sm-8">
    <form method="post"
          id="form"
          action="{{ route('users.update') }}">
      @csrf
      @method('PUT')
      <div>
        <h3 class="title_head">プロフィール</h3>
        <label for="name" class="form-label">名前</label>
        <input type="text"
            id="name"
            class="form-control"
            name="name"
            value="{{ $user->name }}"
            >
      </div>

      <div>
        <label for="email" class="form-lavel mt-3">メールアドレス</label>
        <input type="email"
               id="email"
               class="form-control"
               name="email"
               value="{{ $user->email }}"
        >
      </div>

      <button type="submit" 
              class="btn btn-primary mt-3 mb-3"
              id="submit-btn">保存</button>

    </form>

  </div>
  
</div>

@endsection