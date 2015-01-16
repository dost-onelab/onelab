<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "referralstatus".
 *
 * @property integer $referral_id
 * @property string $sampleArrivalDate
 * @property string $shipmentDetails
 * @property integer $status_id
 */
class Referralstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referralstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sampleArrivalDate', 'shipmentDetails', 'status_id'], 'required'],
            [['sampleArrivalDate'], 'safe'],
            [['shipmentDetails'], 'string'],
            [['status_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'referral_id' => 'Referral ID',
            'sampleArrivalDate' => 'Sample Arrival Date',
            'shipmentDetails' => 'Shipment Details',
            'status_id' => 'Status ID',
        ];
    }
}