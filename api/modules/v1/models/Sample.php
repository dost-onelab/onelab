<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "sample".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 * @property string $code
 */
//class Sample extends \yii\db\ActiveRecord
class Sample extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sample';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['referral_id', 'sampleType_id', 'barcode', 'sampleName', 'sampleCode', 'description', 'status_id', 'create_time'], 'required'],
            [['referral_id', 'sampleType_id', 'sampleName', 'description'], 'required'],
            [['referral_id', 'sampleType_id', 'status_id'], 'integer'],
            [['description'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['barcode', 'sampleName'], 'string', 'max' => 50],
            [['sampleCode'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'referral_id' => 'Referral ID',
            'sampleType_id' => 'Sample Type ID',
            'barcode' => 'Barcode',
            'sampleName' => 'Sample Name',
            'sampleCode' => 'Sample Code',
            'description' => 'Description',
            'status_id' => 'Status ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
    
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalyses()
    {
        return $this->hasMany(Analysis::className(), ['sample_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferral()
    {
        return $this->hasOne(Referral::className(), ['id' => 'referral_id']);
    }
    
	public function extraFields()
	{
	    return [
	    	'analyses' => 'analyses'
	    ];
	}
}