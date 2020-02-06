<?php

//このファイルの場所
namespace  App\Services\Room;

//使うファイルのディレクトリ
use App\Models\_common\CategoryData;
use App\Models\_common\RoomData;
use App\Models\_common\CommentData;
use App\Models\_common\UserData;

//このファイルのクラス名と役割
class IndexService
{
    protected $_category;
    protected $_room;
    protected $_user;
    protected $_comment;

    //全体で使う変数等を定義
    public function __construct(
        CategoryData $category,
        RoomData $room,
        UserData $user,
        CommentData $comment
    )
    {
        $this->_category = $category;
        $this->_room = $room;
        $this->_user = $user;
        $this->_comment = $comment;
    }

    //ルームの情報を取得
    public function getRoomInfo($param)
    {
        //ユーザーIDを取得
        $param['user_id'] = \Auth::guard('user')->Id();
        //ルーム情報を取得
        $data = $this->_room->getRoomData($param['room_id']);
        //もしデータが空だったらfalseを返す
        if (empty($data)) {
            return false;
        };
        //もしルームの作成者が今のユーザーと一緒なら
        $data['can_edit'] = false;
        if ($data['creator_id'] == $param['user_id']) {
            //編集許可フラグを立てる
            $data['can_edit'] = true;
        }

        return $data;
    }

    //コメント一覧を取得
    public function getCommentList($param)
    {
        //ユーザーIDを取得
        $param['user_id'] = \Auth::guard('user')->Id();
        //コメントのIDリストを取得
        $result = $this->_comment->getCommentIdList($param['room_id']);
        //それぞれのIDに対して
        foreach ($result['data'] as $comment) {
            //コメントの情報を取得
            $comment = $this->_comment->getCommentData($comment['comment_id']);
            $comment['can_edit'] = false;
            //コメントの作成者と今のユーザーが一緒なら編集許可フラグを立てる
            if ($comment['user_id'] == $param['user_id']) {
                $comment['can_edit'] = true;
            }
            $comment['img_exists'] = file_exists("storage/user_image/user_{$comment['user_id']}.jpg");
            $result['comment_list'][] = $comment;
        }
        return $result;
    }

    //カテゴリの候補リストを取得
    public function getCategoryList()
    {
        //カテゴリの候補リストを取得
        $category_list = $this->_category->getCategoryListForSuggest();

        return $category_list;
    }

    //新しいルームを作成
    public function createNewRoom($param)
    {
        //ユーザーIDを取得
        $param['user_id'] = \Auth::guard('user')->Id();

        \DB::beginTransaction();
        try {

            //同名のカテゴリが存在していたらIDを取得
            $param['category_id'] = $this->_category->isExistCategory($param['category_name']);
            //取得したIDが空なら、カテゴリを新規作成
            if (empty($param['category_id'])) {
                $param['category_id'] = $this->_category->createNewCategory($param);
            }

            //ルームを作成
            $room_id = $this->_room->createNewRoom($param);

            // トランザクション終了
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        //カテゴリのカウントを更新
        $this->_category->updateCategoryRoomCount();

        return $room_id;
    }

    //ルームを編集
    public function editRoom($param)
    {
        //ユーザーIDを取得
        $param['user_id'] = \Auth::guard('user')->Id();
        \DB::beginTransaction();
        try {

            //同名のカテゴリが存在していたらIDを取得
            $param['category_id'] = $this->_category->isExistCategory($param['category_name']);
            //取得したIDが空なら、カテゴリを新規作成
            if (empty($param['category_id'])) {
                $param['category_id'] = $this->_category->createNewCategory($param);
            }
            //ルーム情報を更新
            $result = $this->_room->updateRoom($param);

            // トランザクション終了
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        //ルームカウントを更新
        $this->_category->updateCategoryRoomCount();

        return $result;
    }

    //ルームを削除
    public function deleteRoom($param)
    {
        //ユーザーIDを取得
        $param['user_id'] = \Auth::guard('user')->Id();
        //ルームを削除
        $result = $this->_room->deleteRoom($param);
        //ルームカウントを更新
        $this->_category->updateCategoryRoomCount();

        return $result;
    }
}
