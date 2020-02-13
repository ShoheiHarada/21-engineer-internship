<?php


//このファイルの場所
namespace  App\Http\Controllers\Room;

//使用するファイル
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\ActionRequest;
use App\Http\Requests\Room\IndexRequest;
use App\Services\Room\IndexService;

//このファイルのクラス名と役割
class IndexController extends Controller
{
    //画面表示
    public function index(IndexRequest $request, IndexService $service)
	{
        //バリデーションとパラメータ取得
        $param = $request->all();
        //serviceのgetRoomInfo()を起動
        if (!$data['room_data'] = $service->getRoomInfo($param)) {
            //失敗するとエラーを表示
            return redirect('/')->with('alert' , '指定されたルームは削除されたか存在しません。');
        };
        //serviceのgetCommentList()を起動
        $data += $service->getCommentList($param);

        $data['room_id'] = $param['room_id'];

        //取得したデータを使ってビューを表示
        return view('Room.index')->with($data);
	}

	//ルーム作成画面
	public function create(IndexService $service)
	{
	    //カテゴリの候補を取得
		$data['category_list'] = $service->getCategoryList();

        return view('Room.create')->with($data);
	}

	//ルーム作成
	public function actionCreate(ActionRequest $request, IndexService $service)
	{
	    $param = $request->all();
	    $room_id = $service->createNewRoom($param);

		return redirect("/room?room_id={$room_id}&new_room_created=true");
	}

	//ルーム編集
	public function actionEdit(ActionRequest $request, IndexService $service)
	{
	    $param = $request->all();
	    $service->editRoom($param);

		return redirect("/room?room_id={$param['room_id']}&edited=1");
	}

	//ルーム削除
	public function actionDelete(IndexRequest $request, IndexService $service)
	{
	    $param = $request->all();
	    $service->deleteRoom($param);

		return redirect('/')->with('success', 'ルームを削除しました');
	}
}