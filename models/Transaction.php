<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $payment_system_to_user_id
 * @property integer $type
 * @property string $amount
 * @property integer $status
 * @property string $comment_admin
 * @property string $creation_date
 * @property string $change_date
 *
 * @property User $user
 * @property PaymentSystemToUser $paymentSystemToUser
 */
class Transaction extends \yii\db\ActiveRecord
{
    const STATUS_ADDED = 0;
    const STATUS_CHECKED = 1;
    const STATUS_CONFIRMED = 2;

    const TYPE_INCOME_ADDED = 0;
    const TYPE_OUTCOME_ADDED = 1;
    const TYPE_INCOME_CHECKED = 2;
    const TYPE_OUTCOME_CHECKED = 3;
    const TYPE_INCOME_BANNED = 4;
    const TYPE_OUTCOME_BANNED = 5;
    const TYPE_INCOME_COMPLETED = 6;
    const TYPE_OUTCOME_COMPLETED = 7;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'creation_date',
                'updatedAtAttribute' => 'change_date',
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
            [['user_id', 'type', 'amount', 'status'], 'required'],
            [['user_id', 'payment_system_to_user_id', 'type', 'status'], 'integer'],
            [['amount'], 'number'],
            [['creation_date', 'change_date', 'comment_admin'], 'safe'],
            [['comment_admin'], 'string', 'max' => 255]
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
            'payment_system_to_user_id' => Yii::t('model', 'ID Кошелька Пользователя'),
            'type' => Yii::t('model', 'Тип операции'),
            'amount' => Yii::t('model', 'Сумма операции'),
            'status' => Yii::t('model', 'Статус операции'),
            'comment_admin' => Yii::t('model', 'Примечания админа'),
            'creation_date' => Yii::t('model', 'Дата создания'),
            'change_date' => Yii::t('model', 'Дата изменения'),
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
    public function getPaymentSystemToUser()
    {
        return $this->hasOne(PaymentSystemToUser::className(), ['id' => 'payment_system_to_user_id']);
    }
}
