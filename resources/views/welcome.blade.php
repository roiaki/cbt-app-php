@extends('layouts.app')

@section('content')

        <div class="center jumbotron" style="margin-top:20px">
            <div class="text-center">
                <h1>認知行動療法的なWebアプリ</h1>
                <p style="margin-top:20px">3コラム、7コラムで思考の癖を把握して、<br> 認知のゆがみを取りましょう。</p>
                <h2 style="margin-top:30px">May your heart suffer less</h2>
                <div style="margin-top:40px">
                {!! link_to_route('signup.get', '会員登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
                </div>
            </div>
        </div>
   
@endsection