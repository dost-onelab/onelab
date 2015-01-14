<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "referral_sample_analysis".
 *
 * @property integer $id
 * @property integer $sample_id
 * @property integer $testName_id
 * @property integer $methodReference_id
 * @property double $fee
 * @property integer $referral_id
 * @property string $barcode
 * @property string $sampleName
 * @property string $sampleCode
 * @property string $description
 * @property string $testName
 * @property string $method
 * @property string $reference
 */
class ReferralSampleAnalysis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referral_sample_analysis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sample_id', 'testName_id', 'methodReference_id', 'referral_id'], 'integer'],
            [['sample_id', 'testName_id', 'methodReference_id', 'fee'], 'required'],
            [['fee'], 'number'],
            [['description'], 'string'],
            [['barcode', 'sampleName'], 'string', 'max' => 50],
            [['sampleCode'], 'string', 'max' => 20],
            [['testName', 'method', 'reference'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sample_id' => 'Sample ID',
            'testName_id' => 'Test Name ID',
            'methodReference_id' => 'Method Reference ID',
            'fee' => 'Fee',
            'referral_id' => 'Referral ID',
            'barcode' => 'Barcode',
            'sampleName' => 'Sample Name',
            'sampleCode' => 'Sample Code',
            'description' => 'Description',
            'testName' => 'Test Name',
            'method' => 'Method',
            'reference' => 'Reference',
        ];
    }
}