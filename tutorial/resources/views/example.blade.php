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
    

    <body class="container" style ="background-color : #000" ; color= "FFF"><h1 class="mb-4　rounded border border-dark p-1">Fukami Ryota</h1>
    <img class="mb-4 rounded border border-dark p-1" src="/storage/example.jpg" width="900px" height="400px">





    <button type="button" class="btn btn-primary btn-lg btn-block">写真の投稿サイト</button>

    <form method="get" action="/example">
            <input class="row"ctype="search" name="kennsaku" value='' placeholder="検索">
            <input class="row"ctype="submit" value="検索">
       
            <div class="row"c>       <!--formとtableのあるdivを囲うdiv-->
            <form class="col-3" method="get" action="/example">
                ~
            </form>
            <div class="container">

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
                    <td><a href=/room?room_id =" {{ $room['room_id'] }}">{{ $room['title'] }}</a></td>
                            <td>{{ $room['category_name'] }}</td>
                            <td>{{ $room['creator'] }}</td>
                            <td>{{ $room['created_date'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
     </div>

     <style> 
    
    </body>
</html>