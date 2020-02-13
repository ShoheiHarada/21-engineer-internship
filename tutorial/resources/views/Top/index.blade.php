@extends('_common.base_layout')

@if(!\Auth::guard('user')->check())
    @section('jumbotron')
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-secondary">
        <div class="container">
            <div class="col-md-8 px-0">
                <h1 class="display-4 font-italic">チャットツール<br>にようこそ！</h1>
                <p class="lead my-3">
                    これは、簡単なチャットツールです。<br>
                    ルームを作って、ブログを書き込んだり、質問したり、雑談したりできます。<br>
                    使い方は人それぞれです。あなたなりの使い方を探してみましょう。<br>
                    早速サインアップして、ルームを作成してみましょう！<br>
                </p>
            </div>
        </div>
    </div>
    @endsection
@endif

@section('contents')
<div class="row">
    <div class="col-md-8">
        <div>
            @if (isset($search))
                <h2>「{{$search}}」の検索結果</h2>
            @else
                <h2>新着ルーム</h2>
            @endif
            <hr>
        </div>
        @include('_common.paginate_bar')
        @if (isset($room_list))
            @foreach($room_list as $room)
                <div>
                    <div class="card flex-md-row mb-2">
                        <div class="card-body align-items-start">
                            <a href="/category/detail?category_id={{$room['category_id']}}" class="mb-2 text-primary font-weight-bold" title="{{$room['category_name']}}">
                                {{ mb_substr($room['category_name'],0,30) }}
                                @if(mb_strlen($room['category_name']) > 30)
                                    ...
                                @endif
                            </a>
                            <span class="mb-1 text-muted">{{ $room['created_date'] }}</span>
                            <h4 class="mb-0">
                                <a class="text-dark" href="/room?room_id={{ $room['room_id'] }}" title="{{$room['title']}}">
                                    {{ mb_substr($room['title'],0,50) }}
                                    @if(mb_strlen($room['title']) > 50)
                                        ...
                                    @endif
                                </a>
                            </h4>
                            <p class="card-text mb-auto"  title="{{$room['body']}}">
                                {{ mb_substr($room['body'],0,40) }}
                                @if(mb_strlen($room['body']) > 40)
                                    ...
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div>
                <div class="card alert-dark flex-md-row mb-2">
                    <div class="card-body">
                        <p class="card-text mb-auto text-center">チャットルームが見つかりませんでした。</p>
                    </div>
                </div>
            </div>
        @endif
        @include('_common.paginate_bar')
    </div>
    <div class="col-md-4">
        @include('_common.sidebar')
    </div><!-- /.row -->
</div>
@endsection