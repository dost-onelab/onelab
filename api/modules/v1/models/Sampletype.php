<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "sampletype".
 *
 * @property integer $id
 * @property integer $lab_id
 * @property string $type
 * @property integer $status_id
 */
class Sampletype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sampletype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_id', 'type', 'status_id'], 'required'],
            [['lab_id', 'status_id'], 'integer'],
            [['type'], 'string', 'max' => 75]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lab_id' => 'Lab ID',
            'type' => 'Type',
            'status_id' => 'Status ID',
        ];
    }
}