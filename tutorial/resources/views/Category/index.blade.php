@extends('_common.base_layout')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            <div>
                @if (isset($category_search))
                    <h2>「{{$category_search}}」のカテゴリ検索結果</h2>
                @else
                    <h2>カテゴリ一覧</h2>
                @endif
                <div class="p-3">
                    <form method="get" action="/category">
                        <div class="input-group justify-content-end">
                            <input type="search" class="rounded" name="category_search" value="{{isset($category_search) ? $category_search : ''}}" placeholder="カテゴリ名で検索">
                            <button type="submit" class="btn btn-success px-4"><i class="fa fa-fw fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <hr>
            </div>
            @include('_common.paginate_bar')
            <div>
                @if(!empty($category_list))
                    <ul class="clearfix p-0 card-columns">
                            @foreach($category_list as $category)
                                <li class="card p-3 text-center justify-content-center">
                                    <a href="category/detail?category_id={{$category['category_id']}}" class="h-100 w-100 text-decoration-none text-dark">
                                        {{ mb_substr($category['category_name'],0,15) }}
                                        @if(mb_strlen($category['category_name']) > 15)
                                            ...
                                        @endif
                                            ({{ $category['room_count'] }})
                                    </a>
                                </li>
                            @endforeach
                    </ul>
                @else
                    <div class="card alert-dark flex-md-row mb-2">
                        <div class="card-body">
                            <p class="card-text mb-auto text-center">カテゴリが見つかりませんでした。</p>
                        </div>
                    </div>
                @endif
            </div>
            @include('_common.paginate_bar')
        </div>
        <div class="col-md-4">
            @include('_common.sidebar')
        </div><!-- /.row -->
    </div>
@endsection