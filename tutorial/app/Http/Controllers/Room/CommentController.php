<?php


//このファイルの場所
namespace  App\Http\Controllers\Room;


//使うファイルのディレクトリ
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\CommentRequest;
use App\Services\Room\CommentService;

//このファイルのクラス名と役割
class CommentController extends Controller
{
    public function actionPost(CommentRequest $request, CommentService $service)
    {
        //バリデーションとパラメータ取得
        $param = $request->all();
        //CommentServiceのpostNewComment()メソッドを起動
        $service->postNewComment($param);

        //元の画面にリダイレクト
        return redirect("/room?room_id={$param['room_id']}#comment")->with('success', 'コメントを投稿しました');
    }

    public function actionEdit(CommentRequest $request, CommentService $service)
    {
        $param = $request->all();
        $service->editComment($param);

        return redirect("/room?room_id={$param['room_id']}")->with('success', 'コメントを編集しました');
    }

    public function actionDelete(CommentRequest $request, CommentService $service)
    {
        $param = $request->all();
        $service->deleteComment($param);

        return redirect("/room?room_id={$param['room_id']}")->with('success', 'コメントを削除しました');
    }
}