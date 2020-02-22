<?php


//このファイルの場所
namespace  App\Http\Controllers\Top;

//使用するファイル
use App\Http\Controllers\Controller;
use App\Http\Requests\Top\IndexRequest;
use App\Services\Top\IndexService;
use App\Models\_common\UserData;
use App\Models\_common\CommonData;
use App\Models\_common\RoomData;



//このファイルのクラス名と役割
class IndexController extends Controller
{
    protected $_common;

    // protected $_user;
    // public function __construct( UserData $userData)
    // {
    //     $this->_user = $userData;
    // }
    public function __construct(CommonData $commonData)
    {
        $this->_common = $commonData;
    }
    public function index(IndexRequest $request, IndexService $service)
    {
    //バリデーションとパラメータ取得
        $param = $request->all();
        //serviceのgetRoomList()を起動
        $data = $service->getRoomList($param);
        $data['user_id'] = 	$Authed = \Auth::guard()->id();
        //$data['user_info']['img_exists'] = file_exists("storage/user_image/user_{$data['room_list']['category_id']}.jpg");

        // $user_id = \Auth::guard('user')->id();
        // $data['user_info'] = $this->_user->getUserInfo($user_id);
        // $data['user_info']['img_exists'] = file_exists("storage/user_image/user_{$user_id}.jpg");
        
        //preDump($data,1);
        // foreach($data['room_list'] as $room){//preDump($room['created_date'],1);
        //     $date = new \DateTime($room['created_date']);
        //    // preDump(date('Y年m月d日　H時i分s秒', strtotime($room['created_date'])),1);
        //     $room['created_date']=date('Y年m月d日　H時i分s秒', strtotime($room['created_date']));
        //     //preDump($room['created_date'],1);
        //             }
          //preDump($data,1);
        //preDump($data,1);
        $user_id = \Auth::guard('user')->id();

        $data['joined_room'] = $this->_common->getJoinedRoomIdMergedArray($user_id);
        //preDump($data,1);
        
        //取得したデータを使ってビューを表示
        return view('top.index')->with($data);
    }
    public function actionJoinedRoom(IndexRequest $request, IndexService $service, RoomData $roomdata) {
        $user_id = \Auth::guard('user')->id();

        $data['joined_room'] = $this->_common->getJoinedRoomId($user_id);
        $cnt=0;
        foreach($data['joined_room'] as $room){
           // $data[$cnt] ="";
            $data['joined_rooms']['room'.$cnt] = $roomdata->getRoomData($room['room_id']);
            $cnt++;
        }
    //preDump($data,1);
        return view('Room.joined')->with($data);
      }
}