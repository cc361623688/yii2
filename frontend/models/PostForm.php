<?php
namespace  frontend\models;

//post from model
use common\models\PostModel;
use common\models\RelationPostTagsModel;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\db\Query;

class PostForm extends Model{
      public $id;
      public $title;
      public $content;
      public $label_img;
      public $cat_id;
      public $tags;


      public $_lastError = "";

      //define create/update scenes
      const SCENSRIOS_CREATE ='create';
      const SCENSRIOS_UPDATE ='update';

      //define event
      const EVENT_AFTER_CREATE = 'eventAfterCreate';
      const EVENT_AFTER_UPDATE = 'eventAfterUpdate';

      //set scenes
      public function scenarios()
      {
          $scenarios = [
              self::SCENSRIOS_CREATE =>['title','content','label_img','cat_id','tags'],
              self::SCENSRIOS_UPDATE =>['title','content','label_img','cat_id','tags'],
          ];
          return array_merge(parent::scenarios(),$scenarios);
      }

      public  function rules()
      {
          return [
              [['id','title','content','cat_id'],'required'],
              [['id','cat_id'],'integer'],
              ['title','string','min'=>4,'max'=>50],
          ];
      }

      public function attributeLabels()
      {
          return [
              'id'=>Yii::t('common','Id'),
              'title'=>Yii::t('common','Title'),
              'content'=>Yii::t('common','Content'),
              'cat_id'=>Yii::t('common','Cat_id'),
              'label_img'=>Yii::t('common','Label_img'),
              'tags'=>Yii::t('common','Tags'),

          ];
      }
      //get post detail by post_id
      public function getViewById($id)
      {
          $res = PostModel::find()->with('relate.tag','extend')->where(['id'=>$id])->asArray()->one();
          if(!$res){
              throw new \Exception('post is not exists!');
          }

          //formate
          $res['tags']=[];
          if( isset($res['relate']) && !empty($res['relate']) ){
              foreach ($res['relate'] as $list){
                  $res['tags'][] = $list['tag']['tag_name'];

              }
          }
          unset($res['relate']);

          return $res;

      }

    //create post
      public function create()
      {
          //transaction
          $transaction = Yii::$app->db->beginTransaction();

          try{
              $postModel = new PostModel();
              $postModel->setAttributes($this->attributes);

              //get summary
              $postModel->summary = $this->_getSummary();
              $postModel->user_id = Yii::$app->user->identity->id;
              $postModel->user_name= Yii::$app->user->identity->username;

              $postModel->is_avtive = 1;

              $postModel->created_at = time();
              $postModel->updated_at = time();

              if(!$postModel->save()){
                    throw new \Exception('post save filed!');
              }

              $this->id = $postModel->id;
              //event
              $data = array_merge($this->getAttributes(),$postModel->getAttributes());
              $this->_eventAfterCreate($data);

              $transaction->commit();
              return true;

          }catch(\Exception $e){
             $transaction->rollBack();
             $this->_lastError = $e->getMessage();
             return false;
          }
      }
      //substr summary
      private function _getSummary($s = 0,$e = 90,$char = 'utf-8'){
          if(empty($this->content)){
              return null;
          }
          return (mb_substr(str_replace("&nbsp;",'',strip_tags($this->content)),$s,$e,$char));
      }
      //add events after post create
      public function _eventAfterCreate($data){
          //add events
          $this->on(self::EVENT_AFTER_CREATE,[$this,'_eventAddTag'],$data);
          //trigger event
          $this->trigger(self::EVENT_AFTER_CREATE);

      }
      //add tags
      public function _eventAddTag($event){
          $tag = new TagForm();

          $tag->tags = $event->data['tags'];
          $tagIds = $tag->saveTags();

          //delete relations
          RelationPostTagsModel::deleteAll(['post_id'=> $event->data['id']]);

          //bulk save post and tags relations
          if(!empty($tagIds)){
              foreach ($tagIds  as $key => $id){
                  $rows[$key]['post_id'] = $this->id;
                  $rows[$key]['tag_id'] = $id;
              }

              //bulk Insert
              $res = (new Query())->createCommand()
                  ->batchInsert(RelationPostTagsModel::tableName(),['post_id','tag_id'],$rows)
                  ->execute();

              if(!$res){
                  throw  new \Exception('RelationPostTags save filed!');
              }

          }

      }
      //获取文章列表
      public static function getList($cond,$curPage=1,$pageSize = 5,$orderBy = ['id'=>SORT_DESC]){
          $postModel = new PostModel();
          $select = ['id','title','summary','label_img','cat_id','user_id','user_name','is_valid','created_at','updated_at'];
          $query = $postModel->find()
              ->select($select)
              ->where($cond)
              ->with('relate.tag','extend')
              ->orderBy($orderBy);
          //获取分页数据
          $res = $postModel->getPages($query,$curPage,$pageSize);
          //格式化数据
          $res['data'] = self::_formateList( $res['data'] );

          return $res;
      }
      //数据
      public static function _formateList($data){
          //print_r($data);die();

          foreach ($data as &$list){
              $list['tags'] = [];
              if(isset($list['relate']) && !empty($list['relate'])){
                  foreach ($list['relate'] as $lt){
                      $list['tags'][] = $lt['tag']['tag_name'];
                  }
              }
              unset($list['relate']);
          }


          return $data;
      }

}