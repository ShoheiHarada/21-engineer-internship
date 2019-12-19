{{--タブメニュー--}}
<div class="py-1 mb-2">
    <nav class="nav d-flex border-bottom border-secondary">
        {{--今いるURLが一致すれば背景を暗くする--}}
        <a class="text-light rounded-top mr-1 p-2 text-decoration-none @if (Request::is('/')) 'bg-dark' @else 'bg-secondary'@endif" href="/">ホーム</a>
        <a class="text-light rounded-top mr-1 p-2 text-decoration-none @if (Request::is('/category')) 'bg-dark' @else 'bg-secondary'@endif" href="/category">カテゴリ一覧</a>
    </nav>
</div>
