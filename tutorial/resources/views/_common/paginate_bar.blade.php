{{--ページネーションバー--}}
@php
    //ここで出てくる変数は、Laravelのクエリビルダで自動生成されたものが多い
    //現在のページから最初と最後のページを設定
    if ($current_page <= 3 || $last_page <= 5) {
        $start = 1;
        $end = 5;
    } elseif ($current_page + 2 >= $last_page ) {
        $start = $last_page - 4;
        $end = $last_page;
    } else {
        $start = $current_page - 2;
        $end = $current_page + 2;
    }
    //検索ワードを引き継ぎ
    if (isset($search)) {
        $search_param = "&search={$search}";
    }elseif (isset($category_search)) {
        $search_param = "&category_search={$category_search}";
    }else{
        $search_param = '';
    }
    //IDを引き継ぎ
    if (isset($room_id)) {
        $id_param = "&room_id={$room_id}";
    }elseif (isset($category_id)) {
        $id_param = "&category_id={$category_id}";
    }else{
        $id_param = '';
    }
@endphp
<div class="my-3" id="paginate">
    <div class="text-center">
        <div class="btn-group btn-group-sm" role="group">
            @if($current_page > 1)
                <a class="btn btn-sm text-primary" href="{{ $first_page_url.$id_param.$search_param.'#paginate' }}">
                        {{'<<'}}
                </a>
                <a class="btn btn-sm text-primary" href="{{ $prev_page_url.$id_param.$search_param.'#paginate' }}">
                        {{'<'}}
                </a>
            @endif
            <span class="btn btn-sm text-primary">
                @if($start > 1)
                    ...
                @endif
            </span>
            @for($i = $start ; $i <= $end && $i <= $last_page; $i++)
                <a class="btn btn-sm text-primary {{ $i == $current_page ? 'font-weight-bold' : '' }}" href="{{ $path.'?page='.$i.$id_param.$search_param.'#paginate' }}">
                        {{ $i }}
                </a>
            @endfor
            <span class="btn btn-sm text-primary">
                @if($end < $last_page)
                    ...
                @endif
            </span>
            @if($current_page < $last_page)
                <a class="btn btn-sm text-primary" href="{{ $next_page_url.$id_param.$search_param.'#paginate' }}">
                        {{'>'}}
                </a>
                <a class="btn btn-sm text-primary" href="{{ $last_page_url.$id_param.$search_param.'#paginate' }}">
                        {{'>>'}}
                </a>
            @endif
        </div>
    </div>
    <div class="text-right mt-n4">
        <span class="text-muted small">{{$from}}～{{$to}}件/全{{$total}}件</span>
    </div>
</div>
