
<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>チャットツール</title>
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
</head>

<body class="bg-light">


<div class="container py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-md-9">
            <a class="h1 text-decoration-none bg-dark text-light py-2 px-3 rounded" href="/">チャットツール</a>
        </div>
        <div class="col-3 d-flex justify-content-end align-items-center">
            <a class="btn btn-outline-primary mr-2" href="/sign-up">アカウント作成</a>
        </div>
    </div>
</div>

<main role="main" class="container">
    @include('_common.tab_menu')
    <div class="jumbotron p-3 p-md-5 rounded bg-secondary">
        <div class="container">
            <div class="card col-md-6 offset-md-3 d-flex p-5">
                <h4 class="text-center">ログイン</h4>
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <p class="m-0">{{ $errors->first() }}</p>
                    </div>
                @endif
                @if (session('loginError'))
                    <div class="alert alert-danger text-center">
                        {!! session('loginError') !!}
                    </div>
                @endif
                <form method="post" action="/login" class="form-group">
                    {{ csrf_field() }}
                    <div class="d-block mb-4">
                        <label for="address">メールアドレス</label>
                        <input type="text" name="address" class="w-100 rounded" value="{{ !empty(session('address')) ? session('address') : old('address') }}">
                    </div>
                    <div class="d-block mb-4">
                        <label for="password">パスワード</label>
                        <input type="password" name="password" class="w-100 rounded" value="{{ old('password') }}">
                    </div>
                    <div>
                        <input type="submit" class="btn btn btn-primary w-100" value="ログイン">
                    </div>
                </form>
                <div class="text-center mb-4">アカウント作成は<a href="/sign-up">こちら</a>から</div>
            </div>
        </div>
    </div>
</main><!-- /.container -->

<footer class="blog-footer bg-secondary py-3">
    <p class="text-center text-white">tutorial for engineer intern by agex.co</p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.js"></script>
</body>
</html>