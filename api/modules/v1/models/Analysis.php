<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "analysis".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 * @property string $code
 */
//class Analysis extends \yii\db\ActiveRecord
class Analysis extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analysis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'sample_id', 'methodReference_id', 'status_id', 'create_time'], 'required'],
            [['sample_id', 'testName_id', 'methodReference_id', 'fee'], 'required'],
            [['id', 'sample_id', 'methodReference_id', 'status_id'], 'integer'],
            [['create_time', 'update_time'], 'safe']
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
            'testName_id' => 'Analysis',
            'methodReference_id' => 'Method Reference ID',
            'fee' => 'Fee',
            'status_id' => 'Status ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}