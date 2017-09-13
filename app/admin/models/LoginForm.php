<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/4/29
 * Time: 上午10:24
 */

namespace app\admin\models;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [

            'username' => '账号',
            'password' => '密码',
            'rememberMe'=>'记住我'
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if($user->is_del==1){
                $this->addError($attribute, '账号已被删除,如有疑问请联系管理员!');
            }

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '密码不正确!');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->adminUser->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Admin::findByUsername($this->username);
            if(!$this->_user) {
                $this->addError('username', '账号不存在');
                return;
            }
            $this->_user->scenario = 'update';
//            $access_token =  $this->_user->createToken();
//            $this->_user->access_token = $access_token;
            $this->_user->last_login_time=time();
            $this->_user->save();
        }

        return $this->_user;
    }
}