<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property integer $status
 * @property string $creation_date
 * @property string $change_date
 *
 * @property User $user
 * @property Order $order
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id', 'status', 'creation_date', 'change_date'], 'required'],
            [['user_id', 'order_id', 'status'], 'integer'],
            [['creation_date', 'change_date'], 'safe'],
            [['user_id', 'order_id'], 'unique', 'targetAttribute' => ['user_id', 'order_id'], 'message' => 'The combination of ID Пользователя and ID Заказа has already been taken.']
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
            'order_id' => Yii::t('model', 'ID Заказа'),
            'status' => Yii::t('model', 'Статус выполнения'),
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
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
