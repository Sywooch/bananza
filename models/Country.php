<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%country}}".
 *
 * @property integer $id
 * @property string $short_name
 * @property string $name
 *
 * @property CountryIncludeToOrder[] $countryIncludeToOrders
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_name', 'name'], 'required'],
            [['short_name'], 'string', 'max' => 2],
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
    public function getCountryIncludeToOrders()
    {
        return $this->hasMany(CountryIncludeToOrder::className(), ['country_id' => 'id']);
    }
}
