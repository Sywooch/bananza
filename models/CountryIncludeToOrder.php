<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%country_include_to_order}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $country_id
 *
 * @property Order $order
 * @property Country $country
 */
class CountryIncludeToOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country_include_to_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'country_id'], 'required'],
            [['order_id', 'country_id'], 'integer'],
            [['order_id', 'country_id'], 'unique', 'targetAttribute' => ['order_id', 'country_id'], 'message' => 'The combination of ID Заказа and ID Страны has already been taken.']
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
            'country_id' => Yii::t('model', 'ID Страны'),
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
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
}
