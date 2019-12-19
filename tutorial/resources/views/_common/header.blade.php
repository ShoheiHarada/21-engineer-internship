{{--header--}}
<header>
	<div class="container py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<div class="col-md-9">
				<a class="h1 text-decoration-none bg-dark text-light py-2 px-3 rounded" href="/">チャットツール</a>
			</div>
			<div class="col-3 d-flex justify-content-end align-items-center">
				@if(\Auth::guard('user')->check())
					{{--ユーザーがログインしていたらログアウトボタンを表示--}}
					<a class="btn btn-outline-secondary bg-light" href="/logout">ログアウト</a>
				@else
					<a class="btn btn-outline-primary bg-light mr-2" href="/sign-up">アカウント作成</a>
					<a class="btn btn-outline-secondary bg-light" href="/login">ログイン</a>
				@endif
			</div>
		</div>
	</div>
</header>
{{--End header--}}
