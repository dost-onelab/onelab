<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "lab_sampletype_testname_method_service".
 *
 * @property integer $lab_id
 * @property string $labName
 * @property integer $sampleType_id
 * @property string $type
 * @property integer $testName_id
 * @property string $testName
 * @property integer $methodreference_id
 * @property string $method
 * @property string $reference
 * @property double $fee
 * @property integer $agency_id
 */
class LabService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_sampletype_testname_method_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_id', 'sampleType_id', 'testName_id', 'methodreference_id', 'agency_id'], 'integer'],
            [['method', 'reference', 'fee'], 'required'],
            [['fee'], 'number'],
            [['labName'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 75],
            [['testName', 'method', 'reference'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lab_id' => 'Lab ID',
            'labName' => 'Lab Name',
            'sampleType_id' => 'Sample Type ID',
            'type' => 'Type',
            'testName_id' => 'Test Name ID',
            'testName' => 'Test Name',
            'methodreference_id' => 'Methodreference ID',
            'method' => 'Method',
            'reference' => 'Reference',
            'fee' => 'Fee',
            'agency_id' => 'Agency ID',
        ];
    }
}