<?php
namespace frontend\models;

use common\models\FeedModel;
use yii\base\Model;
use Yii;

class FeedForm extends Model{
    public $content;

    public $_lastError;

    public function rules()
    {
        return [
            ['content','required'],
            ['content','string','max'=>255],
        ];
    }
    public function attributeLabels()
    {
        return [
           'id'=>'ID',
           'content'=>'Content',
        ];
    }
    //获取评论列表
    public function getList()
    {
        $model =  new FeedModel();

        $res = $model->find()
             ->limit(10)
             ->with('user')
             ->orderBy(['id'=>SORT_DESC])
             ->asArray()
             ->all();
        return $res ? $res : [];
    }
    //创建评论
    public function create(){
        try{
            $model = new FeedModel();
            $model->user_id = Yii::$app->user->identity->id;
            $model->content = $this->content;
            $model->created_at = time();
            if(!$model->save()){
              throw new \Exception('保存失败！');
            }
            return true;
        }catch (\Exception $e){
           $this->_lastError = $e->getMessage();
           return false;
        }
    }
}