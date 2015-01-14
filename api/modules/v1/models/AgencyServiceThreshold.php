<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "agency_service_threshold".
 *
 * @property string $code
 * @property string $name
 * @property integer $region_id
 * @property integer $agency_id
 * @property integer $method_ref_id
 * @property integer $availableSlots
 */
class AgencyServiceThreshold extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agency_service_threshold';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','region_id', 'agency_id', 'method_ref_id', 'availableSlots'], 'integer'],
            [['agency_id', 'method_ref_id'], 'required'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'region_id' => 'Region ID',
            'agency_id' => 'Agency ID',
            'method_ref_id' => 'Method Ref ID',
            'availableSlots' => 'Available Slots',
        ];
    }
}