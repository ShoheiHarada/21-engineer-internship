@extends('_common.base_layout')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            <div>
                <h2>「{{ $category_data['category_name'] }}」のルーム一覧</h2>
                <hr>
            </div>
            @include('_common.paginate_bar')
            @if (isset($room_list))
                {{--ルームリストがあれば一覧を作成--}}
                @foreach($room_list as $room)
                    <div>
                        <div class="card flex-md-row mb-2">
                            <div class="card-body align-items-start">
                                <a href="/category/detail?category_id={{$room['category_id']}}" class="mb-2 text-primary font-weight-bold" title="{{$room['category_name']}}">
                                    {{--30文字で切って--}}
                                    {{ mb_substr($room['category_name'],0,30) }}
                                    {{--「...」をつける--}}
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
                {{--ルームリストがなければ--}}
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