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
     @php
            preDump($room_index);
        @endphp
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
                    <tr>
                        <td>title</td>
                        <td>category_name</td>
                        <td>creator</td>
                        <td>created_date</td>
                    </tr>
                </tbody>
            </table>
     </div>
</body>
</html>