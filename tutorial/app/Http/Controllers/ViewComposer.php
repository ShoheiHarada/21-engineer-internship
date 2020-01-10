<?php

//このファイルの場所
namespace  app\Http\Controllers;

//使うファイルのディレクトリ
use App\Models\_common\UserData;
use Illuminate\Contracts\View\View;
use App\Models\_common\CommonData;

//このファイルのクラス名と役割
class ViewComposer
{
    protected $_common;
    protected $_user;

    public function __construct(CommonData $commonData, UserData $userData)
    {
        $this->_common = $commonData;
        $this->_user = $userData;
    }

    public function compose(View $view)
    {
        $data = $view->getData();
        //ログイン状態をチェック
        if (\Auth::guard('user')->check()) {
            //ログイン状態なら各情報を取得
            //ユーザーID
            $user_id = \Auth::guard('user')->id();
            //ユーザー情報
            $data['user_info'] = $this->_user->getUserInfo($user_id);
            //作成したルーム
            $data['user_info']['created_room'] = $this->_common->getCreatedRoom($user_id);
            //投稿したコメント数
            $data['user_info']['posted_comment'] = $this->_common->getPostedComment($user_id);
            //参加したルーム数
            $data['user_info']['joined_room'] = $this->_common->getJoinedRoom($user_id);
            //プロフィール画像の有無
            $data['user_info']['img_exists'] = file_exists("storage/user_image/user_{$user_id}.jpg");
        }
        //コメント数ランキング
        $data['comment_ranking'] = $this->_common->getRanking();

        return $view->with($data);
    }
}
