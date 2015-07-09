<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%user_login}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $ip
 * @property integer $result
 * @property string $creation_date
 *
 * @property User $user
 */
class UserLogin extends \yii\db\ActiveRecord
{
    const RESULT_FAIL = 0;
    const RESULT_SUCCESS = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_login}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'creation_date',
                'updatedAtAttribute' => FALSE,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ip', 'result'], 'required'],
            [['user_id', 'result'], 'integer'],
            [['creation_date'], 'safe'],
            [['ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'user_id' => Yii::t('model', 'User ID'),
            'ip' => Yii::t('model', 'Ip'),
            'result' => Yii::t('model', 'Result'),
            'creation_date' => Yii::t('model', 'Creation Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
/*
    public function beforeSave($insert)
    {
        if ( !empty($insert) )
        {
            $this->touch('creation_date');
        }

        return parent::beforeSave($insert);
    }
*/
}
