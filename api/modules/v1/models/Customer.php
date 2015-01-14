<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 * @property string $code
 */
//class Customer extends \yii\db\ActiveRecord
class Customer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerName', 'agencyHead', 'region_id', 'province_id', 'municipalityCity_id', 'barangay_id', 'houseNumber', 'tel', 'fax', 'email', 'type_id', 'nature_id', 'industry_id'], 'required'],
            [['region_id', 'province_id', 'municipalityCity_id', 'barangay_id', 'type_id', 'nature_id', 'industry_id', 'created_by'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['customerName', 'agencyHead', 'tel', 'fax', 'email'], 'string', 'max' => 50],
            [['houseNumber'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerName' => 'Customer Name',
            'agencyHead' => 'Agency Head',
            'region_id' => 'Region ID',
            'province_id' => 'Province ID',
            'municipalityCity_id' => 'Municipality City ID',
            'barangay_id' => 'Barangay ID',
            'houseNumber' => 'House Number',
            'tel' => 'Tel',
            'fax' => 'Fax',
            'email' => 'Email',
            'type_id' => 'Type ID',
            'nature_id' => 'Nature ID',
            'industry_id' => 'Industry ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->create_time =  date('Y-m-d H:i:s');
            return true;
        } else {
            return false;
        }
    }
}