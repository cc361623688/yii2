<?php
namespace frontend\models;

use common\models\TagModel;
use yii\base\Model;

//tag from model

class TagForm extends Model{
    public $id;

    public $tags;

    public function rules()
    {
        return [
            ['tags','required'],
            ['tags','each','rule'=>'string'],
        ];
    }

    public function saveTags(){
        $ids = [];
        if(!empty($this->tags)){
            foreach ($this->tags as $key => $tag){
                $ids[] = $this->_saveTag($tag);

            }
        }
        return $ids;
    }
    //save tag
    private function _saveTag($tag){

        $model = new TagModel();

        $res = $model->find()->where(['tag_name'=>$tag])->one();
        if(!$res){
            $model->tag_name = $tag;
            $model->post_num = 1;
            if(!$model->save()){
                throw new \Exception('tag save filed!');
            }
        }else{
            $res->updateCounters(['post_num'=>1]);
        }
        return $model->id;
    }

}