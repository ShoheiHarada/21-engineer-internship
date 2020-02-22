<?php


//このファイルの場所
namespace  App\Http\Controllers\Room;

//使用するファイル
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\ActionRequest;
use App\Http\Requests\Room\IndexRequest;
use App\Services\Room\IndexService;
use App\Models\_common\FavoriteRoomData;
use App\Models\_common\UserData;
use App\Models\_common\RoomData;
use App\Services\ExampleService;
use App\Services\Room\favIndexService;


//このファイルのクラス名と役割
class IndexController extends Controller
{
    //画面表示
    public function index(IndexRequest $request, IndexService $service, UserData $user,FavoriteRoomData $favorite_room)
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
				
				
				$Authed = \Auth::guard()->id();
				$data['user_flag'] = $user->getUserAdminData($Authed);
				
				//preDump($flg,1);

        $data['room_id'] = $param['room_id'];

				//preDump($data,1);
				$param['user_id']=$Authed;
				$param['room_id']=(int)$param['room_id'];
			//	preDump($param,1);

				$data['favorite_room'] = $favorite_room->getFavoriteRoom($param);
				//preDump($data,1);
        //取得したデータを使ってビューを表示
        return view('Room.index')->with($data);
	}

	//ルーム作成画面
	public function create(IndexService $service)
	{
	    //カテゴリの候補を取得
		$data['category_list'] = $service->getCategoryList();

	//	preDump($data,1);
        return view('Room.create')->with($data);
	}

	//ルーム作成
	public function actionCreate(ActionRequest $request, IndexService $service)
	{
	    $param = $request->all();
			$room_id = $service->createNewRoom($param);
//preDump($room_id,1);
if(isset($param['room_image'])) {
	$request->file('room_image')->storeAs('public/room_image',"room_$room_id.jpg");
}
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
		//	preDump($param,1);
	    $service->deleteRoom($param);

		return redirect('/')->with('success', 'ルームを削除しました');
	}
	//お気に入り
	public function actionFavorite( IndexService $service)
	{
		
			$param['room_id']=(int)$_POST['room_id'];
			//preDump($param,1);
			$service->favoriteRoom($param);
			
			return redirect("/room?room_id={$param['room_id']}&favorite=1");

	}
	//新しいお気に入り
	public function actionNewFavorite( IndexService $service)
	{
		
			$param['room_id']=(int)$_POST['room_id'];
			//preDump($param,1);
			$service->newfavoriteRoom($param);
		 
			return redirect("/room?room_id={$param['room_id']}&newfavorite=1");

	}
	//お気に入り解除
	public function actionUnFavorite( IndexService $service)
	{
		
			$param['room_id']=(int)$_POST['room_id'];
			//preDump($param,1);
			$service->unfavoriteRoom($param);
			
			return redirect("/room?room_id={$param['room_id']}&unfavorite=1");

	}
	//お気に入りの部屋
	public function actionMyFavoriteRoom(FavoriteRoomData $favorite_room,RoomData $service) {
    $Authed = \Auth::guard()->id();
		$param['user_id']=$Authed;
   // $data = $service->getRoomList($param);
		$data['user_id']=$Authed;
//preDump($data,1);

	//	$data['my_favorite_room'] = $favorite_room->getMyFavoriteRoom($param);
//preDump($data,1);

    $data = $service->getRoomIdListByFavorite($data);
		$data['my_favorite_room'] = $favorite_room->getMyFavoriteRoom($param);
		
    //preDump($data,1);
    return view('Room.favorite')->with($data);
	}

	//新しいお気に入りの部屋非同期
	public function actionNewFavoriteHidouki( favIndexService $service)
	{
		//preDump($param,1);
			$param['room_id']=(int)$_POST['room_id'];
			//preDump($param,1);
			$service->newfavoriteRoomHidouki($param);
		
			//return redirect("/room?room_id={$param['room_id']}&newfavorite=1");

	}
}