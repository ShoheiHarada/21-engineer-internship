<!doctype html>
<html lang="ja">
    {{--必要な情報の宣言--}}
    <head>
        <meta charset="utf-8">

        <title>Example</title>
        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
    </head>

    {{--本文--}}
    <body class="container">
      <h1 class="mb-4">Hikaru Matsuyamaのページ</h1>
      <nav class="navbar navbar-expand-sm navbar-dark bg-info mt-3 mb-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">メニュー</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">新規登録</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">データ一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">アクセス</a>
                </li>
            </ul>
        </div>
    </nav>    
      <img id="rob" class="mb-4 rounded border border-dark p-2" src="/storage/example.jpg" width="300px" height="300px">
      <div class="row">
       <form class="col-3" method="get" action="/example">                 <!--フォーム始まり-->
            <input type="search" name="kennsaku" value='' placeholder="ココに入力">    <!--入力欄-->
            <input type="submit" class="btn btn-primary"  value="検索">    <!--送信ボタン-->
        </form>  
        <div class="col-9">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>タイトル</td>
                        <th>カテゴリ</td>
                        <th>作成者</td>
                        <th>作成日</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($room_index as $room)
                    <tr>
                        <td><a href=""/room?room_id={{ $room['room_id'] }}"">{{ $room['title'] }}</td>
                        <td>{{ $room['category_name'] }}</td>
                        <td>{{ $room['creator'] }}</td>
                        <td>{{ $room['created_date'] }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script type="text/javascript" src="js/sample.js"></script>

    </body>
</html>