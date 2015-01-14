<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "methodreference".
 *
 * @property integer $id
 * @property integer $testname_id
 * @property string $method
 * @property string $reference
 * @property double $fee
 * @property string $create_time
 * @property string $update_time
 */
class Methodreference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'methodreference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['testname_id', 'method', 'reference', 'fee', 'create_time'], 'required'],
            [['testname_id', 'method', 'reference', 'fee'], 'required'],
            [['testname_id'], 'integer'],
            [['fee'], 'number'],
            [['create_time', 'update_time'], 'safe'],
            [['method', 'reference'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'testname_id' => 'Testname ID',
            'method' => 'Method',
            'reference' => 'Reference',
            'fee' => 'Fee',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}