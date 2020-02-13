<aside class="blog-sidebar">
	{{--ログイン状態ならユーザー情報を表示--}}
	@if(\Auth::guard('user')->check())
		<div class="card mb-4">
			<a href="/mypage" class="text-dark text-decoration-none w-100 h-100">
				<div class="card-header p-1">
					<h5 class="font-weight-bold m-0">
						@if($user_info['img_exists'])
							<img class="rounded-circle" src="/storage/user_image/user_{{\Auth::guard('user')->Id()}}.jpg" alt="プロフィール画像" width="30px" height="30px">
						@else
							<img class="rounded-circle" src="/storage/user_image/noImage.png" alt="プロフィール画像" width="30px" height="30px">
						@endif
						{{$user_info['name']}}
					</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-4 px-1">
							<h6 class="text-center small">ルーム作成数</h6>
						</div>
						<div class="col-4 px-1">
							<h6 class="text-center small">コメント数</h6>
						</div>
						<div class="col-4 px-1">
							<h6 class="text-center small">参加したルーム数</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-4 px-1">
							<h3 class="text-center">{{ $user_info['created_room'] }}</h3>
						</div>
						<div class="col-4 px-1">
							<h3 class="text-center">{{ $user_info['posted_comment'] }}</h3>
						</div>
						<div class="col-4 px-1">
							<h3 class="text-center">{{ $user_info['joined_room'] }}</h3>
						</div>
					</div>
				</div>
			</a>
			<hr class="m-1">
			<div class="card-body p-1">
				<a href="/room/create" class="btn btn-outline-primary btn-block"><i class="fa fa-fw fa-plus"></i>新規ルームを作成</a>
			</div>
		</div>
	@else
		{{--ログインしていなければレコメンドを表示--}}
		<div class="p-3 mb-3 alert-dark rounded">
			<h5 class="font-weight-bold">あなたもコメントしてみましょう</h5>
			<p class="mb-0 p-3">アカウントを作成し<a href="/login">ログイン</a>すると、ルームを作成したり、ルームにコメントすることができます。<br>アカウントの作成は、<a
						href="/sign-up">こちら</a>から</p>
		</div>
	@endif
	{{--検索フォーム--}}
	<div class="p-3">
		<form method="get" action="/">
			<div class="input-group w-100">
				<input type="search" class="rounded w-75" name="search" value="@if(isset($search)){{$search}}@endif" placeholder="検索">
				<button type="submit" class="btn btn-primary px-4 w-25"><i class="fa fa-fw fa-search"></i></button>
			</div>
		</form>
	</div>
	<div class="p-3">
		<h4>コメント数ランキング</h4>
		<table class="mb-0 table-bordered table-striped w-100">
			<thead>
			<tr>
				<th class="small" width="30px">順位</th>
				<th class="small">ルーム名</th>
				<th class="small" width="70px">コメント数</th>
			</tr>
			</thead>
			<tbody>
				@php($i = 1)
				@foreach($comment_ranking as $rank)
					<tr>
						<td class="text-center">{{ $i }}</td>
						<td>
							<a href="/room?room_id={{ $rank['room_id'] }}" title="{{$rank['title']}}">
								{{ mb_substr($rank['title'],0,20) }}
								@if(mb_strlen($rank['title']) > 20)
									...
								@endif
							</a>
						</td>
						<td class="text-center">{{ $rank['comment_count'] }}</td>
					</tr>
					@php( $i++ )
				@endforeach
			</tbody>
		</table>
	</div>
</aside><!-- /.blog-sidebar -->
