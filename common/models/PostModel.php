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
 * @property string $label_image
 * @property integer $category_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $is_avtive
 * @property integer $cerated_at
 * @property integer $updated_at
 *
 * @property Category $category
 * @property User $user
 */
class PostModel extends BaseModel
{
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
            [['category_id', 'user_id', 'is_avtive', 'cerated_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_image', 'user_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'summary' => 'Summary',
            'content' => 'Content',
            'label_image' => 'Label Image',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'is_avtive' => 'Is Avtive',
            'cerated_at' => 'Cerated At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
