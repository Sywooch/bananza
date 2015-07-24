<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RecoverForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => Yii::t('user', 'password'),
            'password_repeat' => Yii::t('user', 'password_repeat'),
        ];
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['password', 'string', 'min'=>6, 'max'=>32],
            [['password', 'password_repeat'], 'required'],
            ['password_repeat', 'string', 'min'=>6, 'max'=>32],
            ['password', 'compare', 'compareAttribute'=>'password_repeat'],

        ];
    }

}
