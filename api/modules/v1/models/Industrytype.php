<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "industrytype".
 *
 * @property integer $id
 * @property string $classification
 * @property integer $active
 */
class Industrytype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'industrytype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['classification', 'active'], 'required'],
            [['active'], 'integer'],
            [['classification'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'classification' => 'Classification',
            'active' => 'Active',
        ];
    }
}