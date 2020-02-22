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
    <body>
        <h1>Exampleページ</h1>
        <div>
            <table>
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
                <td><a href="">{{ $room['title'] }}</a></td>
                <td>{{ $room['category_name'] }}</td>
                <td>{{ $room['creator'] }}</td>
                <td>{{ $room['created_date'] }}</td>
            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>