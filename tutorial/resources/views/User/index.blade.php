@extends('_common.base_layout')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="font-weight-bold">プロフィール</h5>
                    </div>
                    <div class="card-body">
                        <div class="px-1 mb-4">
                            <h5 class="text-left text-center">
                                @if($user_data['img_exists'])
                                    <img class="rounded-circle" src="/storage/user_image/user_{{$user_data['user_id']}}.jpg" alt="プロフィール画像" width="200px" height="200px">
                                @else
                                    <img class="rounded-circle" src="/storage/user_image/noImage.png" alt="プロフィール画像" width="200px" height="200px">
                                @endif
                            </h5>
                        </div>
                        <div class="px-1 mb-4">
                            <h5 class="text-left">ユーザー名</h5>
                            <h3 class="text-center font-weight-bold">{{$user_data['name']}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('_common.sidebar')
        </div><!-- /.row -->
    </div>
@endsection
