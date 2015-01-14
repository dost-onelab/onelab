<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "testname".
 *
 * @property integer $id
 * @property integer $sampleType_id
 * @property string $testName
 * @property integer $status_id
 * @property string $create_time
 * @property string $update_time
 */
class Testname extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testname';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sampleType_id', 'testName', 'status_id', 'create_time'], 'required'],
            [['sampleType_id', 'status_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['testName'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sampleType_id' => 'Sample Type ID',
            'testName' => 'Test Name',
            'status_id' => 'Status ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}