<!-- タイトル必須バリデーション表示-->
@if($errors->has('title'))
    @foreach($errors->get('title') as $message)
        <li class="ml-4 my-1 text-danger">{{ $message }}</li>
    @endforeach
@endif

<!-- 内容必須バリデーション表示-->
@if($errors->has('content'))
    @foreach($errors->get('content') as $message)
        <li class="ml-4 my-1 text-danger">{{ $message }}</li>
    @endforeach
@endif