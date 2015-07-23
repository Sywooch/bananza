<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use app\models\UserLogin;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $salt
 * @property integer $type
 * @property string $balance
 * @property string $creation_date
 * @property string $change_date
 *
 * @property Order[] $orders
 * @property PaymentSystemToUser[] $paymentSystemToUsers
 */

// extends \yii\base\Object implements \yii\web\IdentityInterface
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    // Сценарий регистрации
    const SCENARIO_SIGNUP = 'signup';

    const TYPE_EXECUTOR = 0; // Ислолнитель
    const TYPE_CUSTOMER = 1; // Заказчик

    const ERROR_USERNAME_INVALID = 'Неверное имя пользователя.';
    const ERROR_PASSWORD_INVALID = 'Неверный пароль.';
    const ERROR_NONE = 'Вы успешно вошли.';

    public $password_repeat;
    public $verifyCode;

    protected $_id;
    protected $auth_key;

    private $_user = false;
    public $rememberMe = true;

    private static $users = [];


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }


    public function behaviors()
    {
        return [[
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'creation_date',
            'updatedAtAttribute' => 'change_date',
            'value' => new Expression('NOW()'),
        ],];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {


        return [
            // Логин и пароль - обязательные поля
            [['email', 'name', 'password'], 'required'], //, 'creation_date', 'change_date' , 'salt', 'type'
            [['type'], 'integer'],
            [['balance'], 'number'],
            [['creation_date', 'change_date', 'balance'], 'safe'],

            // Длина логина должна быть в пределах от 5 до 30 символов
            ['name', 'string', 'min'=>5, 'max'=>30],
            // Логин должен соответствовать шаблону
            ['name', 'match', 'pattern'=>'/^[A-zА-я][\w]+$/'],
            // Длина пароля не менее 6 символов
            ['password', 'string', 'min'=>6, 'max'=>32],
            // Повторный пароль и почта обязательны для сценария регистрации
            [['password_repeat', 'email'], 'required', 'on'=>self::SCENARIO_SIGNUP],
            // Длина повторного пароля не менее 6 символов
            ['password_repeat', 'string', 'min'=>6, 'max'=>32],
            // Пароль должен совпадать с повторным паролем для сценария регистрации
            ['password', 'compare', 'compareAttribute'=>'password_repeat', 'on'=>self::SCENARIO_SIGNUP],
            // Почта проверяется на соответствие типу
            ['email', 'email', 'on'=>self::SCENARIO_SIGNUP],
            // Почта должна быть в пределах от 6 до 50 символов
            ['email', 'string', 'min'=>6, 'max'=>50],
            // Почта должна быть уникальной
            ['email', 'unique'],
            // Почта должна быть написана в нижнем регистре
            ['email', 'filter', 'filter'=>'mb_strtolower'],

            ['verifyCode', 'captcha', 'on'=>self::SCENARIO_SIGNUP],
            ['verifyCode', 'required', 'on'=>self::SCENARIO_SIGNUP],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'id'),
            'email' => Yii::t('user', 'email'),
            'name' => Yii::t('user', 'name'),
            'password' => Yii::t('user', 'password'),
            'salt' => Yii::t('user', 'salt'),
            'type' => Yii::t('user', 'type'),
            'balance' => Yii::t('user', 'balance'),
            'creation_date' => Yii::t('main', 'creation_date'),
            'change_date' => Yii::t('main', 'change_date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentSystemToUsers()
    {
        return $this->hasMany(PaymentSystemToUser::className(), ['user_id' => 'id']);
    }

    public function beforeValidate()
    {
        $this->type = self::TYPE_CUSTOMER;

        return parent::beforeValidate();
    }

    // После валидации присваиваем пароль, соль и роль.
    public function afterValidate()
    {
        if($this->isNewRecord) {
            $salt = self::randomSalt(6);
            $this->password = self::hashPassword($this->password, $salt);
            $this->salt = $salt;
            // $this->role = 'user';
        }

        return true;
    }

    // Проверка валидности пароля
    public function validatePassword($password)
    {
        return $this->hashPassword($password,$this->salt)===$this->password;
    }

    // Создание хэша пароля
    public function hashPassword($password,$salt)
    {
        return md5($salt.$password);
    }

    // Генерация "соли". Этот метод генерирует случайным образом слово
    // заданной длины. Длина указывается в единственном свойстве метода.
    // Символы, применяемые при генерации, указаны в переменной $chars.
    // По умолчанию, длина соли 32 символа.
    public static function randomSalt($length=32)
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);

        for ($i = 1, $salt = ''; $i <= $length; $i++)
        {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $salt .= $tmp;
        }

        return $salt;
    }

    public static function generateHash()
    {
        return md5(self::randomSalt());
    }

/*
    public function authenticate()
    {
        $user = User::find('LOWER(email)=?', array(strtolower($this->email)));
        vd($user);die();
        if($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else
        {
            $UserLogin = new UserLogin();
            $UserLogin->ip = Yii::$app->request->userIP;

            if(User::hashPassword($this->password, $user->salt) !== $user->password) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
                $UserLogin->result = UserLogin::RESULT_FAIL;
            } else {
                $this->_id = $user->id;
                $this->errorCode = self::ERROR_NONE;
                $UserLogin->result = UserLogin::RESULT_SUCCESS;
            }

            var_dump($UserLogin->save());die();
        }
        return !$this->errorCode;
    }
*/
    public function getId()
    {
        // return $this->_id;
        return $this->getPrimaryKey();
    }

    public static function findByUsername($email)
    {
        // $user = self::find('LOWER(email)=?', array(strtolower($email)));

        // return $this;

        // $user = static::findOne(['email' => $email]);
        // vd($user);

        return static::findOne(['email' => $email]);
    }



    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id/*, 'status' => self::STATUS_ACTIVE*/]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}
