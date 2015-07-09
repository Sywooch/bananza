<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "transaction_wm".
 *
 * @property integer $id
 * @property integer $LMI_MODE
 * @property string $LMI_PAYMENT_AMOUNT
 * @property string $LMI_PAYEE_PURSE
 * @property integer $LMI_PAYMENT_NO
 * @property integer $LMI_PAYER_WM
 * @property string $LMI_PAYER_PURSE
 * @property string $LMI_PAYER_COUNTRYID
 * @property string $LMI_PAYER_PCOUNTRYID
 * @property string $LMI_PAYER_IP
 * @property integer $LMI_SYS_INVS_NO
 * @property integer $LMI_SYS_TRANS_NO
 * @property string $LMI_SYS_TRANS_DATE
 * @property string $LMI_HASH
 * @property string $LMI_PAYMENT_DESC
 * @property string $creation_date
 * @property string $change_date
 * @property string $description
 */
class TransactionWm extends \yii\db\ActiveRecord
{
    const STATUS_ADDED = 0;
    const STATUS_COMPLETED = 1;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_wm';
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
            [['LMI_MODE', 'LMI_PAYMENT_AMOUNT', 'LMI_PAYEE_PURSE', 'LMI_PAYMENT_NO', 'LMI_PAYER_WM', 'LMI_PAYER_PURSE', 'LMI_PAYER_COUNTRYID', 'LMI_PAYER_PCOUNTRYID', 'LMI_PAYER_IP', 'LMI_SYS_INVS_NO', 'LMI_SYS_TRANS_NO', 'LMI_SYS_TRANS_DATE', 'LMI_HASH', 'LMI_PAYMENT_DESC', 'description'], 'required'],
            [['LMI_MODE', 'LMI_PAYMENT_NO', 'LMI_PAYER_WM', 'LMI_SYS_INVS_NO', 'LMI_SYS_TRANS_NO'], 'integer'],
            [['LMI_PAYMENT_AMOUNT'], 'number'],
            [['creation_date', 'change_date'], 'safe'],
            [['description'], 'string'],
            [['LMI_PAYEE_PURSE', 'LMI_PAYER_PURSE', 'LMI_PAYMENT_DESC'], 'string', 'max' => 255],
            [['LMI_PAYER_COUNTRYID', 'LMI_PAYER_PCOUNTRYID'], 'string', 'max' => 2],
            [['LMI_PAYER_IP'], 'string', 'max' => 15],
            [['LMI_SYS_TRANS_DATE'], 'string', 'max' => 17],
            [['LMI_HASH'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'LMI_MODE' => Yii::t('model', 'Указывает, в каком режиме выполнялась обработка запроса на платеж. Может принимать два значения: 0: Платеж выполнялся в реальном режиме, средства переведены с кошелька покупателя на кошелек продавца; 1: Платеж выполнялся в тестовом режиме, средства реальн'),
            'LMI_PAYMENT_AMOUNT' => Yii::t('model', 'Сумма, которую заплатил покупатель. Дробная часть отделяется точкой.'),
            'LMI_PAYEE_PURSE' => Yii::t('model', 'Кошелек продавца, на который покупатель совершил платеж. Формат - буква и 12 цифр.'),
            'LMI_PAYMENT_NO' => Yii::t('model', ' В этом поле передается номер покупки в соответствии с системой учета продавца, полученный сервисом с веб-сайта продавца.'),
            'LMI_PAYER_WM' => Yii::t('model', ' WM-идентификатор покупателя, совершившего платеж.'),
            'LMI_PAYER_PURSE' => Yii::t('model', ' WM-кошелек покупателя, совершающего платеж.'),
            'LMI_PAYER_COUNTRYID' => Yii::t('model', 'двухбуквенный ISO https://ru.wikipedia.org/wiki/ISO_3166-1 код страны текущего местонахождения, которая указана плательщиком'),
            'LMI_PAYER_PCOUNTRYID' => Yii::t('model', 'двухбуквенный ISO https://ru.wikipedia.org/wiki/ISO_3166-1 код страны выдачи паспорта, если паспортные данные указаны плательщиком'),
            'LMI_PAYER_IP' => Yii::t('model', 'IP-адрес плательщика в момент совершения платежа'),
            'LMI_SYS_INVS_NO' => Yii::t('model', ' Номер счета в системе WebMoney Transfer, выставленный покупателю от имени продавца в процессе обработки запроса на выполнение платежа сервисом Web Merchant Interface. Является уникальным в системе WebMoney Transfer.'),
            'LMI_SYS_TRANS_NO' => Yii::t('model', ' Номер платежа в системе WebMoney Transfer, выполненный в процессе обработки запроса на выполнение платежа сервисом Web Merchant Interface. Является уникальным в системе WebMoney Transfer.'),
            'LMI_SYS_TRANS_DATE' => Yii::t('model', 'Дата и время реального прохождения платежа в системе WebMoney Transfer в формате \"YYYYMMDD HH:MM:SS\".'),
            'LMI_HASH' => Yii::t('model', 'Контрольная подпись оповещения о выполнении платежа, которая используется для проверки целостности полученной информации и однозначной идентификации отправителя. Алгоритм формирования описан в разделе Контрольная подпись данных о платеже.'),
            'LMI_PAYMENT_DESC' => Yii::t('model', 'Примечание к платежу, передается для контроля продавцом отсутствия искажений в примечании к платежу. Данное поле передается после обработки функцией URLEncode. Так как форма, передаваемая с сайта продавца на платежный сайт системы передается через клиентс'),
            'creation_date' => Yii::t('model', 'Дата создания'),
            'change_date' => Yii::t('model', 'Дата изменения'),
            'description' => Yii::t('model', 'Description'),
        ];
    }
}
