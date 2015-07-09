<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goal_to_order}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $goal_id
 * @property string $period_seconds
 * @property integer $period_value
 *
 * @property Order $order
 * @property Goal $goal
 */
class GoalToOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goal_to_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'goal_id'], 'required'],
            [['order_id', 'goal_id', 'period_value'], 'integer'],
            [['period_seconds'], 'string'],
            [['order_id', 'goal_id'], 'unique', 'targetAttribute' => ['order_id', 'goal_id'], 'message' => 'The combination of ID Заказа and ID Цели has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'order_id' => Yii::t('model', 'ID Заказа'),
            'goal_id' => Yii::t('model', 'ID Цели'),
            'period_seconds' => Yii::t('model', 'Время периодичности в секундах'),
            'period_value' => Yii::t('model', 'Значение множителя периода'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoal()
    {
        return $this->hasOne(Goal::className(), ['id' => 'goal_id']);
    }
}
