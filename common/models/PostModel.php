<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 * @property User $user
 */
class PostModel extends BaseModel
{

    const IS_VALID = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'user_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common','Id'),
            'title' => Yii::t('common','Title'),
            'summary' => Yii::t('common','Summary'),
            'content' => Yii::t('common','Content'),
            'label_img' => Yii::t('common','Label Image'),
            'cat_id' => Yii::t('common','Category ID'),
            'user_id' => Yii::t('common','User ID'),
            'user_name' => Yii::t('common','User Name'),
            'is_valid' => Yii::t('common','Is Valid'),
            'created_at' => Yii::t('common','Created At'),
            'updated_at' => Yii::t('common','Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
     }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getRelate()
    {
        return $this->hasMany(RelationPostTagsModel::className(),['post_id'=>'id']);
    }
    public function getExtend()
    {
        return $this->hasOne(PostExtendsModel::className(),['post_id'=>'id']);
    }
    public function getCat()
    {
        return $this->hasOne(CatModel::className(),['id'=>'cat_id']);
    }

}
