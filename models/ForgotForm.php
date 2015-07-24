<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ForgotForm extends Model
{
    public $username;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('user', 'username'),
        ];
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username'], 'email'],
            [['username'], 'in', 'range' => ArrayHelper::map(\app\models\User::find()->all(), 'id', 'email'), 'strict' => false, 'message' => Yii::t('user', 'User with this Email not exist.')]
        ];
    }

}
