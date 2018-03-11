<?php
namespace frontend\models;

use common\models\UserModel;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rePassword;
    public $verifyCode;

    //return i18n language
    public function attributeLabels()
    {
        return [
            'username'=>Yii::t('common','Username'),
            'password'=>Yii::t('common','Password'),
            'rememberMe'=>Yii::t('common','Remember Me'),
            'rePassword'=>Yii::t('common','rePassword'),
            'verifyCode'=>Yii::t('common','verifyCode'),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => Yii::t('common','This username has already been taken.')],
            ['username', 'string', 'min' => 3, 'max' => 16],
            ['username', 'match','pattern'=>'/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z_\d]*$/u','message'=>Yii::t('common','User name consists of letters, Chinese characters, numbers, underline, and can not begin with numbers and underscores.')],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\UserModel', 'message' => Yii::t('common','This email address has already been taken.')],

            [['password','rePassword'], 'required'],
            [['password','rePassword'], 'string', 'min' => 6],

            ['rePassword', 'compare', 'compareAttribute' => 'password','message'=>Yii::t('common','The second password is inconsistent.')],

            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
