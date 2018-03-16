<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_extends".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $browser
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class PostExtendsModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'browser' => 'Browser',
            'collect' => 'Collect',
            'praise' => 'Praise',
            'comment' => 'Comment',
        ];
    }
    //更新统计
    public function upCounter($conditon,$attribute,$num)
    {
        $counter = $this->findOne($conditon);
        if(!$counter){
            $this->setAttributes($conditon);
            $this->$attribute = $num;
            $this->save();
        }else{
            $countData[$attribute] = $num;
            $counter ->updateCounters($countData);
        }

    }
}
