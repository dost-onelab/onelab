<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "consolidated_referral".
 *
 * @property integer $id
 * @property string $referralCode
 * @property integer $lab_id
 * @property string $labName
 * @property integer $customer_id
 * @property string $customer
 * @property integer $barangay_id
 * @property integer $municipalityCity_id
 * @property string $address
 * @property integer $receivingAgencyId
 * @property string $referredTo
 * @property string $receivedBy
 * @property integer $status_id
 * @property string $status
 */
class ConsolidatedReferral extends \yii\db\ActiveRecord
{
    public static function primaryKey()
    {
            return ['id'];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consolidated_referral';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lab_id', 'customer_id', 'barangay_id', 'municipalityCity_id', 'receivingAgencyId', 'status_id'], 'integer'],
            [['referralCode', 'receivingAgencyId'], 'required'],
            [['referralCode', 'labName', 'customer', 'referredTo', 'receivedBy'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 352],
            [['status'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'referralCode' => 'Referral Code',
            'lab_id' => 'Lab ID',
            'labName' => 'Lab Name',
            'customer_id' => 'Customer ID',
            'customer' => 'Customer',
            'barangay_id' => 'Barangay ID',
            'municipalityCity_id' => 'Municipality City ID',
            'address' => 'Address',
            'receivingAgencyId' => 'Receiving Agency ID',
            'referredTo' => 'Referred To',
            'receivedBy' => 'Received By',
            'status_id' => 'Status ID',
            'status' => 'Status',
        ];
    }
}