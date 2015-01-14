<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\QueryParamAuth;

/**
 * Referral Controller API
 *
 * @author DOST IX ICT Team <red_x88@yahoo.com>
 */
class ReferralController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Referral';
    public $modelReferralSampleAnalysis = 'api\modules\v1\models\ReferralSampleAnalysis';
    //public $agencyClass = 'api\modules\v1\models\Agency';
    public $agencyServiceThresholdClass = 'api\modules\v1\models\AgencyServiceThreshold';

    public function actions()
    {
        return array_merge(
            parent::actions(),
            [
                'index' => [
                    'class' => 'yii\rest\IndexAction',
                    'modelClass' => $this->modelClass,
                    'checkAccess' => [$this, 'checkAccess'],
                    'prepareDataProvider' => function ($action) {
                        /* @var $model Referral */
                        $model = new $this->modelClass;
                        $query = $model::find();
                        $dataProvider = new ActiveDataProvider(['query' => $query]);
                        //$model->setAttribute('referralCode', @$_GET['referralCode']);
                        //$query->andFilterWhere(['like', 'referralCode', $model->referralCode]);
                        return $dataProvider;
                    }
                ]
            ]
        );
    }

    public function actionSearch()
    {
        if (!empty($_GET)) {
            $model = new $this->modelClass;
            foreach ($_GET as $key => $value) {
                if (!$model->hasAttribute($key)) {
                    throw new \yii\web\HttpException(404, 'Invalid attribute:' . $key);
                }
            }
            try {
                $provider = new ActiveDataProvider([
                    'query' => $model->find()->where($_GET),
                    'pagination' => false
                ]);
            } catch (Exception $ex) {
                throw new \yii\web\HttpException(500, 'Internal server error');
            }

            if ($provider->getCount() <= 0) {
                throw new \yii\web\HttpException(404, 'No entries found with this query string');
            } else {
                return $provider;
            }
        } else {
            throw new \yii\web\HttpException(400, 'There are no query string');
        }
    }

    public function actionAgency()
    {
        if (!empty($_GET)) {
            $model = new $this->modelReferralSampleAnalysis;
            $modelAgency = new $this->agencyServiceThresholdClass;
            foreach ($_GET as $key => $value) {
                if (!$model->hasAttribute($key)) {
                    throw new \yii\web\HttpException(404, 'Invalid attribute:' . $key);
                }
            }
            try {

                $analyses = $model->find()->where('referral_id = :referral_id', [':referral_id' => $_GET['id']])->all();
                
                //$text = '';
                $count = 0;
                $method_ref_ids = [];
                foreach($analyses as $analysis)
                {
                    array_push($method_ref_ids, $analysis->methodReference_id);
                    $count += 1;
                }

                /* find() */
                $availableAgencies = $modelAgency->find()
                    ->select('*, COUNT(method_ref_id) AS methodMatches')
                    ->where(['IN', 'method_ref_id', $method_ref_ids])
                    ->groupBy('agency_id')
                    ->having('methodMatches = :methodMatches')
                    ->addParams([':methodMatches'=>$count])
                    ->all();
                
                /* findBySql() */
                //$sql = 'SELECT *, COUNT(`method_ref_id`) AS methodMatches FROM `agency_service_threshold` WHERE `method_ref_id` IN ('.$text.') GROUP BY `agency_id` HAVING methodMatches=2';
                //$availableAgencies = $modelAgency->findBySql($sql)->all();

                $provider = new ActiveDataProvider([
                    'query' => $modelAgency->find()
                                ->select('*, COUNT(method_ref_id) AS methodMatches')
                                ->where(['IN', 'method_ref_id', $method_ref_ids])
                                ->groupBy('agency_id')
                                ->having('methodMatches = :methodMatches')
                                ->addParams([':methodMatches'=>$count]),
                    'pagination' => false
                ]);

            } catch (Exception $ex) {
                throw new \yii\web\HttpException(500, 'Internal server error');
            }

            if ($provider->getCount() <= 0) {
                throw new \yii\web\HttpException(404, 'No entries found with this query string');
            } else {
                //return $provider;
                return $availableAgencies;
            }
        } else {
            throw new \yii\web\HttpException(400, 'There are no query string');
        }
    }
}


