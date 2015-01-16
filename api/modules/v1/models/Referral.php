<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "referral".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 * @property string $code
 */
//class Referral extends \yii\db\ActiveRecord
class Referral extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referral';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['referralCode', 'referralDate', 'receivingAgencyId', 'acceptingAgencyId', 'lab_id', 'customer_id', 'paymentType_id', 'discount_id', 'reportDue', 'conforme', 'receivedBy', 'cancelled', 'status', 'create_time'], 'required'],
            [['referralDate', 'receivingAgencyId', 'lab_id', 'customer_id', 'paymentType_id', 'discount_id', 'reportDue', 'conforme', 'receivedBy'], 'required'],
            [['receivingAgencyId', 'acceptingAgencyId', 'lab_id', 'customer_id', 'paymentType_id', 'discount_id', 'cancelled', 'status'], 'integer'],
            [['referralDate', 'sampleArrivalDate', 'reportDue', 'create_time', 'update_time'], 'safe'],
            [['referralCode'], 'string', 'max' => 50],
            [['referralTime'], 'string', 'max' => 10],
            [['conforme', 'receivedBy'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'referralCode' => 'Referral Code',
            'referralDate' => 'Referral Date',
        	'referralTime' => 'Referral Time',
            'receivingAgencyId' => 'Receiving Agency ID',
            'acceptingAgencyId' => 'Accepting Agency ID',
            'lab_id' => 'Lab ID',
            'customer_id' => 'Customer ID',
            'paymentType_id' => 'Payment Type ID',
            'discount_id' => 'Discount ID',
            'sampleArrivalDate' =>  'Sample Arrival',
            'reportDue' => 'Report Due',
            'conforme' => 'Conforme',
            'receivedBy' => 'Received By',
            'cancelled' => 'Cancelled',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
    
	public function getSamples()
    {
        return $this->hasMany(Sample::className(), ['referral_id' => 'id']);
    }
    
	public function getAnalyses()
    {
        return $this->hasMany(ReferralSampleAnalysis::className(), ['referral_id' => 'id']);
    }
    
	public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    
	public function extraFields()
	{
	    return [
	    	'samples', 
	    	'customer',
	    	'analyses'
	    ];
	}
	
	public function beforeSave($insert)
	{
	    if (parent::beforeSave($insert)) {

	    	if ($this->isNewRecord) { 
     			$this->referralCode = Referral::generateReferralCode($this->lab_id);
				$this->referralDate = date('Y-m-d',strtotime($this->referralDate));
				$this->referralTime = time();
				$this->reportDue = date('Y-m-d',strtotime($this->reportDue));
				$this->create_time =  date('Y-m-d H:i:s');
	    	}
  	
	        return true;
	    } else {
	        return false;
	    }
	}
	
	function generateReferralCode($lab){
		$monthYear = date('mY', strtotime($this->referralDate));
		
		$referral = Referral::find()
					->where('lab_id = :lab_id', [':lab_id' => $lab])
					->orderBy([
					       'create_time'=>SORT_DESC,
					       'id' => SORT_DESC,
						])
					->one();
		
		if(isset($referral)){
			$referralCode = explode('-', $referral->referralCode);
			$number = Referral::addZeros($referralCode[3] + 1);
		}else{
			$number = Referral::addZeros(1);
		}
		
		$labCode = Lab::find()
					->where('id = :id', [':id' => $lab])
					->one();
		
		$agency = Agency::find()
					->where('id = :id', [':id' => $this->receivingAgencyId])
					->one();
					
		$referralCode = $agency->code.'-'.$monthYear.'-'.$labCode->labCode.'-'.$number;
		
		return $referralCode;
		
	}
	
	function addZeros($count){
		if($count < 10)
			return '000'.$count;
		elseif ($count < 100)
			return '00'.$count;
		elseif ($count < 1000)
			return '0'.$count;
		elseif ($count >= 1000)
			return $count;
	}
}