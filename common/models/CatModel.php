<?php

namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $category_name
 *
 * @property Posts[] $posts
 */
class CatModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['category_id' => 'id']);
    }
    //get all categories
    public function getAllCats()
    {
        //default category
        $cats[0] = Yii::t('common', 'No Category');
        $res = self::find()->asArray()->all();
//        echo "<pre>";
//        print_r($res);die();
        if (count($res)) {
            foreach ($res as $key => $row) {
                $cats[$row['id']] = $row['cat_name'];
            }
        }
        return $cats;
    }



}
