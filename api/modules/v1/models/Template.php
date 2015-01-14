<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * Template Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class Template extends ActiveRecord 
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'sampletemplate';
	}

    /**
     * Define rules for validation
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 150]
        ];
    }   
}
