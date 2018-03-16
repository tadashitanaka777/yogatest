<?php

namespace Manage;

class Login
{
    public function __construct()
    {
    }
    public function getLoginPossibleList($accountId)
    {
        global $wpdb;
        $rst = null;
        //var_dump($wpdb);
        $result = $wpdb->get_results("
            SELECT *
            FROM  accountpermission
            WHERE
            (
                applicationId = $accountId
                OR  permissionId = $accountId
            )
            AND status = '1'
        ");
        // var_dump($wpdb->queries);
        foreach ($result as $value) {
            // var_dump($value->applicationId);
            if ($value->applicationId <> $accountId) {
                $rst[] = $value->applicationId;
            }
            if ($value->permissionId <> $accountId) {
                $rst[] = $value->permissionId;
            }
        }
        // var_dump($rst);
        return $rst;
        //exit;
    }
    public function changeLoginUser($userId, $mb5pass)
    {
        global $wpdb;
        $result = $wpdb->get_results("
            SELECT *
            FROM  wp_users
            WHERE ID = $userId
            AND user_pass = '$mb5pass'
        ");
        // var_dump($result);
        // exit;
        if($result[0]->ID){
            wp_set_current_user($result[0]->ID);
            wp_set_auth_cookie($result[0]->ID);
            return true;
        }
        return false;
    }
}
