<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%app}}".
 *
 * @property integer $id
 * @property string $service
 * @property string $service_appname
 * @property string $name
 * @property integer $type
 * @property string $creation_date
 * @property string $change_date
 *
 * @property Order[] $orders
 */
class App extends \yii\db\ActiveRecord
{
    const TYPE_FREE = 0;
    const TYPE_PAY = 1;

    const SERVICE_GOOGLE = 'google';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%app}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service'], 'string'],
            [['service_appname', 'name', 'type'], 'required'], // , 'creation_date', 'change_date'
            [['type'], 'integer'],
            [['creation_date', 'change_date'], 'safe'],
            [['service_appname', 'name'], 'string', 'max' => 255]
        ];
    }

    public function behaviors()
    {
        return [[
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'creation_date',
            'updatedAtAttribute' => 'change_date',
            'value' => new Expression('NOW()'),
        ],];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'service' => Yii::t('app', 'Сервис'),
            'service_appname' => Yii::t('app', 'ID в сервисе'),
            'name' => Yii::t('app', 'Название'),
            'type' => Yii::t('app', 'Тип'), // платное/бесплатное?
            'creation_date' => Yii::t('main', 'Дата создания'),
            'change_date' => Yii::t('main', 'Дата изменения'),
        ];
    }

    public function beforeValidate()
    {
        $this->type = self::TYPE_FREE;
        $this->service = self::SERVICE_GOOGLE;

        return parent::beforeValidate();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['app_id' => 'id']);
    }
}
