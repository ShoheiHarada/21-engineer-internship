{{--ベースとなるレイアウト--}}
<!doctype html>
<html lang="ja">
	{{--必要な情報の宣言--}}
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>チャットツール</title>
		<!-- Bootstrap core CSS -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/fontawesome/css/all.min.css">
	</head>

	{{--body--}}
	<body class="bg-light">

		{{--headerのファイルを読み込み--}}
		@include('_common.header')

		{{--tab_menuのファイルを読み込み--}}
		@include('_common.tab_menu')

		{{--section('jumbotron')が入る--}}
		@yield('jumbotron')

		{{--メインコンテンツ--}}
		<main role="main" class="container bg-light rounded">
			{{--エラーメッセージがあれば表示--}}
			@if(session('alert'))
				<div class="alert alert-danger text-center">
					<p class="m-0">{{ session('alert') }}</p>
				</div>
			@endif
			@if(count($errors) > 0)
				<div class="alert alert-danger text-center">
					<p class="m-0">{{ $errors->first() }}</p>
				</div>
			@endif

			{{--section('contents')が入る--}}
			@yield('contents')
		</main><!-- /.container -->

		{{--section('modal')が入る--}}
		@yield('modal')

		{{--ログアウトモーダル--}}
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id=logoutModalLabel">ログアウト</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body bg">
						<p class="mb-2 text-secondary font-weight-bold">ログアウトします。よろしいですか？</p>
						<form action="top.html">
							<div class="d-flex justify-content-end">
								<input type="submit" class="btn btn-secondary px-4" value="はい">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		{{--ページトップに戻るボタン--}}
		<p class="text-center py-3">
			<a href="#" class="btn btn-secondary px-5 text-white text-decoration-none">ページトップに戻る</a>
		</p>

		{{--footer--}}
		<footer class="blog-footer bg-secondary py-3">
			<p class="text-center text-white">tutorial for engineer intern by agex.co</p>
		</footer>
		{{--End footer--}}

		{{--JavaScriptファイルを読み込み--}}
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/bootstrap.bundle.js"></script>
	</body>
	{{--End body--}}
</html>