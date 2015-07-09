<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goal}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property GoalToOrder[] $goalToOrders
 */
class Goal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goal}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
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
            'name' => Yii::t('model', 'Цель'),
            'description' => Yii::t('model', 'Описание'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoalToOrders()
    {
        return $this->hasMany(GoalToOrder::className(), ['goal_id' => 'id']);
    }
}
