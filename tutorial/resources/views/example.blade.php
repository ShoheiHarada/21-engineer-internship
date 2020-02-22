<!doctype html>
<html lang="ja">
{{--必要な情報の宣言--}}

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Example</title>
  <!-- Bootstrap core CSS -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/fontawesome/css/all.min.css">
  <link href="/css/example.css" rel="stylesheet" type="text/css">
</head>

{{--本文--}}

<body>
  <div class="ex-wrapper">
    <header class="container-fluid position-fixed bg-primary text-white ex-zindex-10 ex-height-20">
      <div class="row">
        <div>
          <a class="h2 text-decoration-none bg-dark text-light py-2 px-3 rounded ex-margin-right-100"
            href="/">Exampleページ</a>
        </div>
        <a class="text-light p-2 bg-secondary ex-border-radius-10 ex-margin-right-100" href="/">ホーム</a>
        <nav class="col-sm-8 mt-2">
          <form method="get" action="/example">
            <input class="col-sm-4 position-absolute ex-right-10" ctype="search" name="search"
              value='@if(isset($search)){{$search}}@endif' placeholder="ココに入力">
            <input class="position-absolute ex-right-10" type="submit" class="btn btn-primary" value="検索">
          </form>
        </nav>
      </div>
    </header>
    <img class="position-fixed col-sm-12 ex-zindex-bg ex-padding-0 " src="/storage/background1.jpg" alt="example img"
      width="1200px" height="800px">
    <main role="main" class="container">
      <div class="row">
        <!--formとtableのあるdivを囲うdiv-->
        　　<div class="col-10">
          @if (isset($room_index))
          <div>
            @if (isset($search))
            <h2>「{{$search}}」の検索結果</h2>
            @endif
            <hr>
          </div>
          <div class="ex-margin-top-10 ex-bg-cream">
            @include('_common.paginate_bar')
          </div>
          <table class="table table-bordered table-striped  align-items-center ex-background-color">
            <thead>
              <tr>
                <th>タイトル</td>
                <th>カテゴリ</td>
                <th>作成者</td>
                <th>作成日</td>
              </tr>
            </thead>
            <tbody>

              @foreach($room_list as $room)
              <tr>
                <td><a href="/room?room_id={{ $room['room_id'] }}">{{ $room['title'] }}</a></td>
                <td>{{ $room['category_name'] }}</td>
                <td>{{ $room['creator'] }}</td>
                <td>{{ $room['created_date'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @else
      <div>
        <div class="card alert-dark flex-md-row mb-2 ex-margin-top-10">
          <div class="card-body">
            <p class="card-text mb-auto text-center">チャットルームが見つかりませんでした。</p>
          </div>
        </div>
      </div>
      @endif
    </main>
  </div>
  <footer class="ex-footer-bottom">
    <p class="text-center text-white">tutorial for engineer intern by agex.co</p>
  </footer>
</body>

</html>