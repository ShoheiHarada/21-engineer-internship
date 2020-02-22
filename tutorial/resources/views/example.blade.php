<!doctype html>
<html lang="ja">
    {{--必要な情報の宣言--}}
    <head>
        <meta charset="utf-8">

        <title>Example</title>
        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/example.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="/js/example_blade.js"></script> 
    </head>

    {{--本文--}}
    <body class="container">
        <header id="example_header">        
            <h1 class="mb-3 text-left strong"><a href="/" >Example ページ</a></h1>
        </header>
        <nav class="mb-5">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li><a href="#">メニュー1</a></li>
            </ul>
        </nav>
            
      <!--  <img class="mb-4" src="/storage/example.jpg" style="width:30% height:auto"> 
        <div class="row">
            <form class="col-3" method="get" action="/example">
                <input type="search" name="kennsaku" value="" placeholder="ココに入力">
                <input type="submit">
            </form>
        </div>
    -->
        <section class="col-9" id="table">
        <h4>以下でブログのリストを表示します</h3>
            <p><a id="readOnlyRowsToggle" class="btn text-primary btn-outline-primary">show</a></p>
            <table class="table">
                <thead>
                    <tr>
                        <th>タイトル</td>
                        <th>カテゴリ</td>
                        <th>作成者</td>
                        <th>作成日</td>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    define("MAX","3");
                    $num=count($room_index);
                    $max_page=ceil($num/MAX);

                    if(!isset($_GET["page_id"])){
                        $current_page=1;
                    }else{
                        $current_page=$_GET["page_id"];
                    }


                    ?>


                    @foreach($room_index as $room)
                    <tr> {{--class="readOnlyRow">--}} {{--readOnlyRow...表示する表を折りたたむボタン--}}
                        <td><a href="/room?room_id={{$room['room_id']}}" class="text-primary">{{ $room['title']}}</a></td>
                        <td>{{ $room['category_name'] }}</td>
                        <td>{{ $room['creator'] }}</td>
                        <td>{{ $room['created_date'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        {{--commentをpostする --}}
        <form method="post"  action="/example_receive" class="pt-5 ins" style="width: 30rem;">
            {{ csrf_field() }}
            <p>コメント記入欄</p>
            <textarea name="comment" class="form-control" required value="{{old('comment')}}"></textarea>
            <input type="submit" value="送信">
        </form>
        <footer>
            Copyright Toshiki
        </footer>
    </body>
</html>