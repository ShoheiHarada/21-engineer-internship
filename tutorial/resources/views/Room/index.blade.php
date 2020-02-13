@php
    $Authed = \Auth::guard()->check();
@endphp

@extends('_common.base_layout')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            <div>
                <a href="/category/detail?category_id={{$room_data['category_id']}}" class="mb-2 text-primary font-weight-bold">{{ $room_data['category_name'] }}</a>
                <h2>{{ $room_data['title'] }}
                    @if ($room_data['can_edit'])
                        <span class="text-muted float-right">
                            <a href="#" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editRoomModal">編集</a>
                            <a href="#" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteRoomModal">削除</a>
                        </span>
                    @endif
                </h2>
                <p>作成日:{{ date('Y年m月d日 H:i:s', strtotime($room_data['created_date'])) }}　作成者 : {{ $room_data['creator_unsub']? '[退会したユーザー]' : $room_data['creator']}}</p>
                <p class="lead m-3">{!!nl2br($room_data['body'])!!}</p>
            </div>
            <hr>
            <div>
                @include('_common.paginate_bar')
                @if(!empty($comment_list))
                    @foreach($comment_list as $comment)
                        <div class="card mb-1">
                            <div class="card-body align-items-start">
                                @if($comment['destination_name'] && !$comment['destination_unsub'])
                                    <div class="mt-n3 text-muted">{{ $comment['destination_name'] }}への返信<i class="fa fa-fw fa-reply"></i></div>
                                @elseif($comment['destination_unsub'] == 1)
                                    <div class="mt-n3 text-muted">[退会したユーザー]への返信<i class="fa fa-fw fa-reply"></i></div>
                                @endif
                                @if($comment['user_unsub'])
                                    <span class="mb-2 text-muted font-weight-bold small">[退会したユーザー]</span>
                                @else
                                    <a href="/user?user_id={{$comment['user_id']}}" class="mb-2 text-primary font-weight-bold">
                                        @if($comment['img_exists'])
                                            <img class="rounded-circle" src="/storage/user_image/user_{{$comment['user_id']}}.jpg" alt="プロフィール画像" width="20px" height="20px">
                                        @else
                                            <img class="rounded-circle" src="/storage/user_image/noImage.png" alt="プロフィール画像" width="20px" height="20px">
                                        @endif
                                        {{$comment['user_name']}}
                                    </a>
                                @endif
                                <span class="text-muted float-right">
                                    <time>{{ date('Y年m月d日 H:i:s',  strtotime($comment['created_date'])) }}</time>
                                    @if($Authed && !$comment['can_edit'])
                                        <a href="#" class="fa fa-fw fa-reply text-success text-decoration-none" data-toggle="modal" data-target="#replyModal{{$comment['comment_id']}}" Id="reply"></a>
                                        <!--返信用モーダル-->
                                        <div class="modal fade" id="replyModal{{$comment['comment_id']}}" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="replyModalLabel">コメントに返信</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="room/comment">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="room_id" value="{{ $room_data['room_id'] }}">
                                                            <input type="hidden" name="destination_id" value="{{ $comment['user_id'] }}">
                                                            <p>{{ $comment['user_name'] }}に返信</p>
                                                            <textarea class="w-100" name="comment_body" maxlength="500" placeholder="コメントを記入" rows="5"></textarea>
                                                            <div class="d-flex justify-content-end">
                                                                <input type="submit" class="btn btn-primary px-4">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($comment['can_edit'])
                                        <a href="#" class="fa fa-fw fa-pen text-primary text-decoration-none" data-toggle="modal" data-target="#editModal{{$comment['comment_id']}}"></a>
                                        <a href="#" class="fa fa-fw fa-trash text-muted text-decoration-none" data-toggle="modal" data-target="#deleteModal{{$comment['comment_id']}}"></a>
                                        <!--編集用モーダル-->
                                        <div class="modal fade" id="editModal{{$comment['comment_id']}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">コメントを編集</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <a href="#" class="mb-2 text-success font-weight-bold">{{ $comment['user_name'] }}</a>
                                                        <form method="post" action="room/comment/edit">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="comment_id" value="{{ $comment['comment_id'] }}">
                                                            <input type="hidden" name="room_id" value="{{ $room_data['room_id'] }}">
                                                            <textarea class="w-100 my-3 rounded" name="comment_body" maxlength="500" placeholder="コメントを記入" rows="5">{{ $comment['comment_body'] }}</textarea>
                                                            <div class="d-flex justify-content-end">
                                                                <input type="submit" class="btn btn-primary px-4">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--削除用モーダル-->
                                        <div class="modal fade" id="deleteModal{{$comment['comment_id']}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">コメントを削除</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="mb-2 text-danger font-weight-bold">コメントを削除します。</p>
                                                        <form method="post" action="room/comment/delete">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="comment_id" value="{{ $comment['comment_id'] }}">
                                                            <input type="hidden" name="room_id" value="{{ $room_data['room_id'] }}">
                                                            <div class="d-flex justify-content-end">
                                                                <input type="submit" class="btn btn-danger px-4" value="確認">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                <p class="card-text mb-auto font-weight-bold">{!!nl2br($comment['comment_body'])!!}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card alert-secondary flex-md-row mb-1 py-5">
                        <div class="card-body h4 font-weight-bold text-center">
                            まだコメントはありません。<br>最初のコメントをしてみましょう。
                        </div>
                    </div>
                @endif
                @include('_common.paginate_bar')
            </div>
            <hr>
            @if($Authed)
                <h4>新しいコメント</h4>
                <div class="alert-secondary p-4 border rounded shadow-sm mb-3" id="comment">
                    <form method="post" action="room/comment">
                        {{ csrf_field() }}
                        <input type="hidden" name="room_id" value="{{ $room_data['room_id'] }}">
                        <textarea class="w-100" name="comment_body" maxlength="500" placeholder="コメントを記入" rows="5">{{ old('comment_body') }}</textarea>
                        <div class="d-flex justify-content-end">
                            <input type="submit" class="btn btn-primary px-4 mt-2">
                        </div>
                    </form>
                </div>
            @else
                <div class="p-3 mb-3 alert-dark rounded">
                    <h5 class="font-weight-bold">あなたもコメントしてみましょう</h5>
                    <p class="mb-0 p-3">アカウントを作成しログインすると、ルームを作成したり、ルームにコメントすることができます。<br>アカウントの作成は、<a
                                href="/sign-up">こちら</a>から</p>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            @include('_common.sidebar')
        </div><!-- /.row -->
    </div>
@endsection

@section('modal')
    <!--編集用モーダル-->
    <div class="modal fade" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="editRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoomModalLabel">チャットルームを編集</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/room/edit">
                        {{ csrf_field() }}
                        <input type="hidden" name="room_id" value="{{ $room_data['room_id'] }}">
                        <input type="text" name="title" class="w-100 my-3" maxlength="100" minlength="1" placeholder="ルーム名を記入" value="{{ $room_data['title'] }}">
                        <input type="text" name="category_name" class="w-100 my-3" maxlength="50" minlength="1" placeholder="ルーム名を記入" value="{{ $room_data['category_name'] }}">
                        <textarea class="w-100 my-3 rounded" name="body" maxlength="500" minlength="1" placeholder="ルーム詳細を記入" rows="5">{{ $room_data['body'] }}</textarea>
                        <div class="d-flex justify-content-end">
                            <input type="submit" class="btn btn-primary px-4">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--削除用モーダル-->
    <div class="modal fade" id="deleteRoomModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoomModalLabel">チャット－ルームを削除</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-2 text-danger font-weight-bold">チャットルームを削除します。</p>
                    <form method="post" action="/room/delete">
                        {{ csrf_field() }}
                        <input type="hidden" name="room_id" value="{{ $room_data['room_id'] }}">
                        <div class="d-flex justify-content-end">
                            <input type="submit" class="btn btn-danger px-4" value="確認">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection