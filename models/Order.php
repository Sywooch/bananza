<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $app_id
 * @property integer $vote_mark_id
 * @property string $name
 * @property string $total_price
 * @property integer $status
 * @property string $creation_date
 * @property string $change_date
 *
 * @property CountryIncludeToOrder[] $countryIncludeToOrders
 * @property GoalToOrder[] $goalToOrders
 * @property User $user
 * @property App $app
 */
class Order extends \yii\db\ActiveRecord
{

    public $countryIds = [];
    public $goals = [];
    public $goal_id;

    const GOAL_DOWNLOAD = 1;
    const GOAL_VOTE = 2;
    const GOAL_DOWNLOAD_VOTE = 3;

    const STATUS_ADDED = 0; // 'Added'
    const STATUS_CONFIRMED = 1; // 'Confirmed'
    const STATUS_COMPLETED = 2; //'Completed'

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'user_id',
            ],
            [
                'class' => TimestampBehavior::className(),
                /*
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['creation_date', 'change_date'],
                    self::EVENT_BEFORE_UPDATE => ['change_date'],
                ],
                */
                'createdAtAttribute' => 'creation_date',
                'updatedAtAttribute' => 'change_date',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => \cornernote\linkall\LinkAllBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'vote_mark_id', 'name', 'total_users', 'goal_id'], 'required'], // , 'creation_date', 'change_date', 'total_price', 'status'
            [['user_id', 'app_id', 'vote_mark_id', 'status', 'total_users'], 'integer'],
            [['total_users'], 'number', 'min' => 10],
            [['total_users'], 'default', 'value' => '10'],
            [['total_price'], 'number'],
            [['user_id', 'creation_date', 'change_date', 'countryIds', 'ref_link', 'description'], 'safe'],
            [['user_id', 'app_id'], 'unique', 'targetAttribute' => ['user_id', 'app_id'], 'message' => 'The combination of ID Пользователя and ID Приложения has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'id'),
            'user_id' => Yii::t('order', 'user_id'),
            'app_id' => Yii::t('order', 'app_id'),
            'vote_mark_id' => Yii::t('order', 'vote_mark_id'),
            'name' => Yii::t('order', 'name'),
            'description' => Yii::t('order', 'description'),
            'ref_link' => Yii::t('order', 'ref_link'),
            'total_users' => Yii::t('order', 'total_users'),
            'total_price' => Yii::t('order', 'total_price'),
            'status' => Yii::t('order', 'status'),
            'creation_date' => Yii::t('main', 'creation_date'),
            'change_date' => Yii::t('main', 'change_date'),
            'countryIds' => Yii::t('order', 'countryIds'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryIncludeToOrders()
    {
        return $this->hasMany(CountryIncludeToOrder::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['id' => 'country_id'])->via('countryIncludeToOrders');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*
    public function setCountries($countryIds)
    {
        return $this->hasMany(Country::className(), ['id' => 'country_id'])->via('countryIncludeToOrders');
    }
    */

    /**
     * @inheritdoc
     */
    /*
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if (!$insert) {
            CountryIncludeToOrder::deleteAll(['order_id' => $this->id]);
//            static::getDb()
//                ->createCommand()
//                ->delete('{{%product_category_assn}}', ['product_id' => $this->id])
//                ->execute();
        }

        if (!empty($this->categoryIds)) {
            static::getDb()
                ->createCommand()
                ->batchInsert(
                    '{{%product_category_assn}}',
                    ['product_id', 'category_id'],
                    array_map(function ($categoryId) { return [$this->id, $categoryId]; }, $this->categoryIds)
                )
                ->execute();
        }
    }
    */


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoalToOrders()
    {
        return $this->hasMany(GoalToOrder::className(), ['order_id' => 'id']);
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
    public function getApp()
    {
        return $this->hasOne(App::className(), ['id' => 'app_id']);
    }

    public function setApp(App $App)
    {
        $this->app = $App;
    }


    public function delete()
    {
        CountryIncludeToOrder::deleteAll(['order_id' => $this->id]);
        GoalToOrder::deleteAll(['order_id' => $this->id]);
        Task::deleteAll(['order_id' => $this->id]);

        return parent::delete();
    }

}