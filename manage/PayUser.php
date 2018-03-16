<?php

namespace Manage;

use \Payjp\Payjp;

class PayUser
{
    public function __construct()
    {
        $this->apiKey = "sk_test_601eb2fe36a9583d4817a68d";
    }
    public function getUserPayinfo($userinfo)
    {
        try {
            \Payjp\Payjp::setApiKey($this->apiKey);
            $umeta = get_user_meta($userinfo->ID);
            // var_dump($umeta);
            $obj = (object)array();
            $obj->ID = $userinfo->ID;
            $obj->email =  $userinfo->user_email;

            $obj->firstName = $umeta['first_name'][0];

            $obj->payjpCusId = $umeta['payjpCusId'][0];
            //初期無料プラン設定
            //月額契約をしていなければ無料プランを設定
            $obj->planName = "plan000";
            $obj->planPrice = 0;
            $obj->planSubId = null;
            if ($obj->payjpCusId <> null) {
                try {
                    $cu = \Payjp\Customer::retrieve($obj->payjpCusId);
                } catch (\Exception $e) {
                    //正しい　PayjpCustomerではない場合。
                    // echo $e->getMessage();
                }
                if ($cu->cards->data[0] <> null) {
                    //cardId::car_*****
                    $obj->cardId     = $cu->cards->data[0]->id;
                    $obj->cardLast4  = $cu->cards->data[0]->last4;
                    $obj->cardBrand  = $cu->cards->data[0]->brand;
                    // var_dump($cu->cards->data[0]);
                }
                if ($cu->subscriptions->data[0]->plan->name <> null) {
                    //定期購読登録ＩＤ
                    //exsample::sub_b336e9f21486076618ec8d6db371
                    $obj->planSubId  = $cu->subscriptions->data[0]->id;
                    $obj->planName   = $cu->subscriptions->data[0]->plan->name;
                    //プランID
                    $obj->planId     = $cu->subscriptions->data[0]->plan->id;
                    $obj->planPrice  = $cu->subscriptions->data[0]->plan->amount;
                    $obj->planStatus = $cu->subscriptions->data[0]->plan->status;
                    $obj->planSubId  = $cu->subscriptions->data[0]->id;
                    // var_dump($cu->subscriptions->data[0]);
                }
            }
        } catch (Exception $e) {
            throw new Exception(__METHOD__.":".__LINE__, 1);
            echo $e->getMessage();
        }

        return $obj;
    }
    /**argument are
     * plan001,plan002
     * @param  [type] $planid [description]
     * @return [type]         [description]
     */
    public function getPlaninfo($planid)
    {
        $obj = (object)array();
        if ($planid == "plan000") {
            $obj->name   = "無料プラン";
            $obj->amount = "0";
            return $obj;
        }
        $obj = \Payjp\Plan::retrieve($planid);
        // var_dump($obj->name);
        // var_dump($obj->name);
        // var_dump($obj);
        // var_dump($obj->amount);
        return $obj;
    }
    /**
     * ユーザーのプランを登録する。
     * @param  [type] $cusId        [cus*********]
     * @param  [type] $prePlanid    [sub+++++++++]
     * @param  [type] $registPlanId [plan001,plan002]
     * @return [type]               [description]
     */
    public function changePlan($payjpCusId, $cancelPlanSubId, $registPlanId)
    {
        if ($registPlanId <> 'plan000') {
            \Payjp\Subscription::create(
                array(
                    "customer" => $payjpCusId,
                    "plan" => $registPlanId
                )
            );
        }
        if (isset($cancelPlanSubId)) {
            $su = \Payjp\Subscription::retrieve($cancelPlanSubId);
            $su->delete();
        }
        return true;
    }
}
