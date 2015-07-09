<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%payment_system_to_user}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $payment_system_id
 * @property string $value
 *
 * @property User $user
 * @property PaymentSystem $paymentSystem
 */
class PaymentSystemToUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment_system_to_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'payment_system_id', 'value'], 'required'],
            [['user_id', 'payment_system_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['user_id', 'payment_system_id'], 'unique', 'targetAttribute' => ['user_id', 'payment_system_id'], 'message' => 'The combination of ID Пользователя and ID Платёжной системы has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'user_id' => Yii::t('model', 'ID Пользователя'),
            'payment_system_id' => Yii::t('model', 'ID Платёжной системы'),
            'value' => Yii::t('model', 'ID в платёжной системе'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentSystem()
    {
        return $this->hasOne(PaymentSystem::className(), ['id' => 'payment_system_id']);
    }
}
