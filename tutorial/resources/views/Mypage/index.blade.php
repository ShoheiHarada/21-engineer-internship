@extends('_common.base_layout')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            <div>
                <h2>アカウント管理</h2>
            </div>
            <hr>
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="font-weight-bold">プロフィール</h5>
                    </div>
                    <div class="card-body">
                        <div class="px-1 mb-4">
                            <h5 class="text-left text-center">
                                <a href="#" data-toggle="modal" data-target="#changeImgModal">
                                    @if($img_exists)
                                        <img class="rounded-circle" src="/storage/user_image/user_{{\Auth::guard('user')->Id()}}.jpg" alt="プロフィール画像" width="200px" height="200px">
                                    @else
                                        <img class="rounded-circle" src="/storage/user_image/noImage.png" alt="プロフィール画像" width="200px" height="200px">
                                    @endif
                                </a>
                            </h5>
                        </div>
                        <div class="px-1 mb-4">
                            <h5 class="text-left">
                                ユーザー名
                                <a href="#" class="float-right small" data-toggle="modal" data-target="#editNameModal">変更</a>
                            </h5>
                            <h3 class="text-center font-weight-bold">{{$user_info['name']}}</h3>
                        </div>
                        <div class="px-1 mb-4">
                            <h5 class="text-left">
                                メールアドレス
                                <a href="#" class="float-right small" data-toggle="modal" data-target="#editAddressModal">変更</a>
                            </h5>
                            <h3 class="text-center font-weight-bold">{{$user_info['address']}}</h3>
                        </div>
                        <div class="px-1 mb-4">
                            <h5 class="text-left">
                                パスワード
                                <a href="#" class="float-right small" data-toggle="modal" data-target="#editPasswordModal">変更</a>
                            </h5>
                            <h5 class="text-center font-weight-bold">＊＊＊＊＊＊＊＊</h5>
                        </div>
                    </div>
                    <hr class="m-1">
                    <div class="card-body p-1">
                        <a href="#" class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#deleteAccountModal">退会</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('_common.sidebar')
        </div><!-- /.row -->
    </div>
@endsection

@section('modal')
<!--編集用モーダル-->
<div class="modal fade" id="changeImgModal" tabindex="-1" role="dialog" aria-labelledby="changeImgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeImgModalLabel">プロフィール画像をアップロード</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/mypage/image" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="mb-2">
                        <input type="file" name="user_image" accept="image/jpeg,jpg,JPG,JPEG">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary px-4" value="変更">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--編集用モーダル-->
<div class="modal fade" id="editNameModal" tabindex="-1" role="dialog" aria-labelledby="editNameModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNameModalLabel">ユーザー名を編集</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/mypage/name">
                    <input type="text" name="name" class="w-100 my-3" placeholder="ユーザ名を記入" value="{{$user_info['name']}}">
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary px-4" value="確定">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--編集用モーダル-->
<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">メールアドレスを変更</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/mypage/address">
                    <input type="text" name="address" class="w-100 my-3" placeholder="メールアドレスを記入" value="{{$user_info['address']}}">
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary px-4" value="確定">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--編集用モーダル-->
<div class="modal fade" id="editPasswordModal" tabindex="-1" role="dialog" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPasswordModalLabel">パスワードを変更</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/mypage/password">
                    <label for="old_password">現在のパスワード</label>
                    <input type="password" name="old_password" class="w-100 mb-3">
                    <label for="new_password1">新しいパスワード</label>
                    <input type="password" name="new_password1" class="w-100 mb-3">
                    <label for="new_password2">新しいパスワード(確認)</label>
                    <input type="password" name="new_password2" class="w-100 mb-3">
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary px-4" value="確定">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--退会モーダル-->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=deleteAccountModalLabel">アカウント削除</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-2 text-secondary font-weight-bold">このアカウントは削除されます。よろしいですか？</p>
                <form action="/mypage/unsub">
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-danger px-4" value="はい">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection