<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "businessnature".
 *
 * @property integer $id
 * @property string $nature
 */
class Businessnature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'businessnature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nature'], 'required'],
            [['nature'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nature' => 'Nature',
        ];
    }
}