@extends('_common.base_layout')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            <div>
                <h2>新規チャットルームを作成</h2>
                <hr>
            </div>
            <form method="post" action="/room/create">
                {{ csrf_field() }}
                <h5>ルーム名</h5>
                <div  class="d-block m-3">
                    <input type="text" class="w-100" name="title" maxlength="100" minlength="1" placeholder="ルーム名を記入" value="{{old('title')}}">
                </div>
                <h5>カテゴリ</h5>
                <div  class="d-block m-3">
                    <input type="text" class="w-100" name="category_name" maxlength="50" minlength="1" placeholder="カテゴリ名を記入" value="{{old('category_name')}}" list="category_list">
                    <datalist id="category_list">
                        @foreach($category_list as $category)
                            <option value="{{$category['category_name']}}"></option>
                        @endforeach
                    </datalist>
                </div>
                <h5 for="title">ルーム詳細</h5>
                <div  class="d-block m-3">
                    <textarea class="w-100" name="body" maxlength="5000" minlength="1" placeholder="ルーム詳細を記入" rows="5">{{old('body')}}</textarea>
                </div>
                <div class="d-flex justify-content-end m-3">
                    <input type="submit" class="btn btn-primary px-4" value="ルームを作成">
                </div>
            </form>
        </div>
        <div class="col-md-4">
            @include('_common.sidebar')
        </div><!-- /.row -->
    </div>
@endsection