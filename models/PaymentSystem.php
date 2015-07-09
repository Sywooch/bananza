<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%payment_system}}".
 *
 * @property integer $id
 * @property string $short_name
 * @property string $name
 *
 * @property PaymentSystemToUser[] $paymentSystemToUsers
 */
class PaymentSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment_system}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_name', 'name'], 'required'],
            [['short_name'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'short_name' => Yii::t('model', 'Краткое название'),
            'name' => Yii::t('model', 'Название'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentSystemToUsers()
    {
        return $this->hasMany(PaymentSystemToUser::className(), ['payment_system_id' => 'id']);
    }
}
