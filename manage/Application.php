<?php

namespace Manage;

class Application
{
    public function __construct()
    {
    }
    /**
     * 申請する　申請中状態のDBへのインサート
     * @param  [type] $applicationId [description]
     * @param  [type] $permissionId  [description]
     * @return [type]                [description]
     */
    public function ApplicationCorp($applicationId, $permissionId)
    {
        global $wpdb;
        //var_dump($wpdb);
        //すでに申請データがないか確認する。-
        $result = $wpdb->get_results("
            SELECT *
            FROM  accountpermission
            WHERE applicationId = $applicationId
            AND permissionId = $permissionId
        ");
        //var_dump($result);
        //exit;
        if ($result == null) {
            # code...
            $result = $wpdb->insert(
                'accountpermission',
                array(
                'applicationId' => $applicationId,
                'permissionId' => $permissionId,
                'status' => 0,
                ),
                array( '%d',
                '%d',
                '%d',
                )
            );
        }
        //echo "<hr />";
        //var_dump($result);
        return $result;
    }

    /**
     * 申請状態の取得
     * @param  [type] $applicationId [description]
     * @param  [type] $permissionId  [description]
     * @return [type]                [description]
     */
    public function getApplicationCorpStatus($applicationId, $permissionId)
    {
        global $wpdb;
        //var_dump($wpdb);
        $result = $wpdb->get_results("
            SELECT *
            FROM  accountpermission
            WHERE applicationId = $applicationId
            AND permissionId = $permissionId
        ");
        $rst = null;
        if (isset($result[0]->status)) {
            $rst = $result[0]->status;
        }
        return $rst;
        // var_dump($result);
        //exit;
    }
    /**
     * 申請状態の表示
     */
    public function showApplicationCorpStatus($status, $permissionId)
    {
        switch ($status) {
            case null:
                echo "<form method='POST'><input type='hidden' name='ID' value='$permissionId' /><input type='submit' value='申請する' class='ui green button'/></form>";
                break;
            case '0':
                echo "申請中";
                break;
            case '1':
                echo "承認済み";
                break;
            case '2':
                echo "申請拒否";
                break;
            case '3':
                echo "-";
                break;
            default:
                echo "error!";
                break;
        }
    }
    public function permittingCorp($permissionId, $status)
    {
        global $wpdb;
        $result = $wpdb->update(
            'accountpermission', //integer
            array(
            'status' => $status,
            ),
            array(
            'id' => $permissionId ),
            array(
            '%d',
            )
        );
        //var_dump($result);
        return $result;
    }
    public function getPermissionCorpList($permissionId)
    {
        global $wpdb;
        //var_dump($wpdb);
        $result = $wpdb->get_results("
            SELECT *
            FROM  accountpermission
            WHERE permissionId = $permissionId
        ");
        return $result;
    }
    public function showPermissionCorpStatus($status, $permissionId)
    {
        echo " <form method='POST'>
               <input type='hidden' name='permissionId' value='$permissionId' />";
        $checked0 = null;
        $checked1 = null;
        $checked2 = null;
        $checked3 = null;
        switch ($status) {
            case '0':
                $checked0 = 'checked="checked"';
                break;
            case '1':
                $checked1 = 'checked="checked"';
                break;
            case '2':
                $checked2 = 'checked="checked"';
                break;
            case '3':
                $checked3 = 'checked="checked"';
                break;
            default:
                break;
        }
        echo "
            <input type='radio' name='permissionCorpStatus' $checked0 value='0'>承認待ち &nbsp;
            <input type='radio' name='permissionCorpStatus' $checked1 value='1'>承認 &nbsp;
            <input type='radio' name='permissionCorpStatus' $checked2 value='2'>拒否 &nbsp;
            <input type='radio' name='permissionCorpStatus' $checked3 value='3'>削除 &nbsp;
            ";
        echo "<input type='submit' value='変更' class='ui green button'/></form>";
    }
    public function applicationPostType($applicationId, $permissionId, $applicationWpPostId, $permissionWpPostId, $postType)
    {
        global $wpdb;
        // var_dump($applicationWpPostId);
        //すでに申請データがないか確認する。
        $result = $wpdb->get_results("
            SELECT *
            FROM  actionpermission
            WHERE applicationWpPostId = $applicationWpPostId
            AND permissionWpPostId = $permissionWpPostId
            AND kind = '$postType'
        ");
        $result2 = null;
        // exit;
        if (!isset($result[0])) {
            // var_dump($result);
            $result2 = $wpdb->insert(
                'actionpermission',
                array(
                'applicationId' => $applicationId,
                'permissionId' => $permissionId,
                'applicationWpPostId' => $applicationWpPostId,
                'permissionWpPostId' => $permissionWpPostId,
                'status' => 0,
                'kind' => $postType,
                ),
                array( '%d',
                '%d',
                '%d',
                '%d',
                '%d',
                '%s',
                )
            );
            // var_dump($result2);
        }
        // var_dump($wpdb->queries);
        //echo "<hr />";
        //var_dump($result);
        return $result2;
    }
    public function applicationPostTypeUpdate($applicationWpPostId, $permissionWpPostId, $postType, $status)
    {
        global $wpdb;
        // var_dump($applicationWpPostId);
        //すでに申請データがないか確認する。
        //    //null 未選択
            //0 申請中
            //1 承認済み
            //2 非承認
        $result = $wpdb->get_results("
            SELECT *
            FROM  actionpermission
            WHERE applicationWpPostId = $applicationWpPostId
            AND permissionWpPostId = $permissionWpPostId
            AND kind = '$postType'
        ");
        // var_dump($result[0]->id);
        $result2 = null;
        // exit;
        if (isset($result[0])) {
            // var_dump($result);
            // idの行のステータスを更新する。
            $result2 = $wpdb->update(
                'actionpermission',
                array(
                    'status' => $status,
                ),
                array(
                'id' => $result[0]->id,
                ),
                array(
                    '%d',
                ),
                array(
                    '%d',
                )
            );
            // var_dump($result2);
        }
        // var_dump($wpdb->queries);
        //echo "<hr />";
        //var_dump($result);
        return $result2;

    }
    /**
     * publish な　posttypeの全ての表示
     * @param  [type] $postType [description]
     * @return [type]           [description]
     */
    public function getPostTypeList($postType)
    {
        global $wpdb;
        //var_dump($wpdb);
        $results = $wpdb->get_results("
         SELECT *
         FROM $wpdb->posts
         WHERE
         post_type = '$postType'
         AND  post_status = 'publish'
     ");
         // var_dump($results);
        return $results;
    }
    /**
     * publish な　posttypeの一部の取得
     * @param  [type] $postType [description]
     * @return [type]           [description]
     */
    public function getPostActionListFromTo($postType, $page, $limit)
    {
        global $wpdb;
        $results = $this->getPostTypeList($postType);
        // var_dump($results);
        $first = $page * $limit-$limit;
         //取得終わり
         $end = $page * $limit;
         foreach ($results as $key => $value) {
             if (($first <= ($key+1)) && (($key+1) < $end)) {
                 $arr[$key+1] = (array)$value;
             }
         }
          // var_dump($first,$end,count($arr),$arr);
          // var_dump($arr);
        return $arr;
    }
    public function isOwnPostTypeList(
        $applicationUserId,
        $permissionUserId,
        $applicationPostType,
        $permissionPostType
    ) {

        //◎自分自身以外はボタン申請不可のaction
        switch ($permissionPostType) {
            case "license":
                if ($applicationPostType == "studio") {
                    if ($applicationUserId <> $permissionUserId) {
                        return false;
                    }
                }
                break;
            case "event":
                if ($applicationPostType == "job") {
                    if ($applicationUserId <> $permissionUserId) {
                        return false;
                    }
                }
                break;
            case "job":
                if ($applicationPostType == "event") {
                    if ($applicationUserId <> $permissionUserId) {
                        return false;
                    }
                }
                if ($applicationPostType == "studio") {
                    if ($applicationUserId <> $permissionUserId) {
                        return false;
                    }
                }
                if ($applicationPostType == "company") {
                    if ($applicationUserId <> $permissionUserId) {
                        return false;
                    }
                }
                if ($applicationPostType == "shop") {
                    if ($applicationUserId <> $permissionUserId) {
                        return false;
                    }
                }
                break;

            case "license":
                if ($applicationPostType == "studio") {
                    if ($applicationUserId <> $permissionUserId) {
                        return false;
                    }
                }
                if ($applicationPostType == "company") {
                    if ($applicationUserId <> $permissionUserId) {
                        return false;
                    }
                }
                break;
            default:
                break;
        }
        return true;
    }
    public function getUserHavePostTypeList($postAuthor, $postType)
    {
        global $wpdb;
        //var_dump($wpdb);
        $results = $wpdb->get_results("
         SELECT *
         FROM $wpdb->posts
         WHERE
         post_type = '$postType'
         and  post_author = $postAuthor
         and  (post_status = 'publish' or post_status = 'private')
     ");
        return $results;
    }
    /**
     * postType　で　IDに該当する一記事（データ）
     * @param  [type] $postAuthor [description]
     * @param  [type] $postId     [description]
     * @param  [type] $postType   [description]
     * @return [type]             [description]
     */
    public function getUserHavePostType($postAuthor, $postId, $postType)
    {
        global $wpdb;
        //var_dump($wpdb);
        $results = $wpdb->get_results("
         SELECT *
         FROM $wpdb->posts
         WHERE
         post_type = '$postType'
         and  ID = $postId
         and  post_author = $postAuthor
         and  post_status = 'publish'
     ");
    // var_dump($wpdb->queries);
     // exit;
        return $results;
    }
    public function getPost($userId, $postId)
    {
        global $wpdb;
        //var_dump($wpdb);
        $results = $wpdb->get_results("
         SELECT *
         FROM $wpdb->posts
         WHERE
         post_author = $userId
         and  ID = $postId
         and  post_status = 'publish'
     ");
     // print_r($wpdb->queries);
        if (!isset($results[0])) {
            // echo "申請データがありません。";
            return null;
            // exit;
        }
        return $results[0];
    }
    public function getPostFromPostId($postId)
    {
        global $wpdb;
        //var_dump($wpdb);
        $results = $wpdb->get_results("
         SELECT *
         FROM $wpdb->posts
         WHERE
         ID = $postId
         and  post_status = 'publish'
     ");
     // print_r($wpdb->queries);
        if (!isset($results[0])) {
            // echo "申請データがありません。";
            return null;
            // exit;
        }
        return $results[0];
    }
    public function showApplicationPostTypeStatus($status, $postAuthor, $applicationWpPostId, $permissionWpPostId, $postType)
    {

        switch ($status) {
            case null:
                echo "
                <form method='POST'>
                    <input type='hidden' name='permissionId' value='$postAuthor' />
                    <input type='hidden' name='applicationWpPostId' value='$applicationWpPostId' />
                    <input type='hidden' name='permissionWpPostId' value='$permissionWpPostId' />
                    <input type='hidden' name='kind' value='$postType' />
                    <input type='submit' value='申請する' class='ui green button'/>
                </form>
                ";
                break;
            case '0':
                echo "申請中";
                break;
            case '1':
                echo "承認済み";
                break;
            case '2':
                echo "申請拒否";
                break;
            case '3':
                echo "-";
                break;
            default:
                echo "error!";
                break;
        }
    }
    //null 未選択
    //0 申請中
    //1 承認済み
    //2 非承認
    public function getApplicationPostTypeStatus($applicationWpPostId, $permissionWpPostId, $postType)
    {
        global $wpdb;
        $result = $wpdb->get_results("
            SELECT *
            FROM  actionpermission
            WHERE applicationWpPostId = $applicationWpPostId
            and permissionWpPostId = $permissionWpPostId
            and kind = '$postType'
        ");
        $rst = null;
        if (isset($result[0]->status)) {
            $rst = $result[0]->status;
        }
        // var_dump($wpdb->queries);
        // var_dump($result);
        return $rst;
    }
    //1 申請中
    //2 未選択
    //3 承認済み
    public function getWpApplicationPostTypeStatus($applicationWpPostId, $permissionWpPostId, $postType)
    {
        try {
            //null 未選択
            //0 申請中
            //1 承認済み
            //2 非承認
            $status =  $this->getApplicationPostTypeStatus($applicationWpPostId, $permissionWpPostId, $postType);
            // var_dump($status);
            $rstStatus = null;
            switch ($status) {
                case '1':
                $rstStatus = 3;
                break;
                case '0':
                $rstStatus = 1;
                break;
                case null:
                $rstStatus = 2;
                break;
                case '2':
                $rstStatus = 0;
                break;
            }
            // var_dump($rstStatus);
        } catch (\Exception $e) {

        }

        return $rstStatus;
    }
    public function getPermissionPostTypeList($permissionId, $postType)
    {
        global $wpdb;
        //var_dump($wpdb);
        $result = $wpdb->get_results("
            SELECT *
            FROM  actionpermission
            WHERE permissionId = $permissionId
            and kind = '$postType'
        ");
        // print_r($wpdb->queries);

        return $result;
    }
    public function getUserPermissionList($permissionId)
    {
        global $wpdb;
        //var_dump($wpdb);
        $result = $wpdb->get_results("
            SELECT *
            FROM  actionpermission
            WHERE permissionId = $permissionId
        ");
        // print_r($wpdb->queries);

        return $result;
    }
    /**
     * 承認側のステータス
     * @param  [type] $status       [description]
     * @param  [type] $permissionId [description]
     * @return [type]               [description]
     */
    public function showPermissionPostTypeStatus($status, $postType, $permissionId)
    {
        echo " <form method='POST'>
               <input type='hidden' name='permissionId' value='$permissionId' />";
        echo " <input type='hidden' name='kind' value='$postType' />";
        $checked0 = null;
        $checked1 = null;
        $checked2 = null;
        $checked3 = null;
        switch ($status) {
            case '0':
                $checked0 = 'checked="checked"';
                break;
            case '1':
                $checked1 = 'checked="checked"';
                break;
            case '2':
                $checked2 = 'checked="checked"';
                break;
            case '3':
                $checked3 = 'checked="checked"';
                break;
            default:
                break;
        }
        echo "
            <input type='radio' name='permissionPostTypeStatus' $checked0 value='0'>承認待ち &nbsp;
            <input type='radio' name='permissionPostTypeStatus' $checked1 value='1'>承認 &nbsp;
            <input type='radio' name='permissionPostTypeStatus' $checked2 value='2'>拒否 &nbsp;
            <input type='radio' name='permissionPostTypeStatus' $checked3 value='3'>削除 &nbsp;
            ";
        echo "<input type='submit' value='変更' class='ui green button'/></form>";
    }
    public function permittingPostType($permissionId, $postType, $status)
    {
        global $wpdb;

        //削除の場合は　物理的に削除する。
        if ($status == 3) {
            $result = $wpdb->delete(
                'actionpermission', //integer
                array(
                'id' => $permissionId,
                ),
                array(
                '%d',
                )
            );
            return $result;
        }


        $result = $wpdb->update(
            'actionpermission', //integer
            array(
            'status' => $status,
            ),
            array(
            'id' => $permissionId,
            'kind' => $postType
            ),
            array(
            '%d',
            '%s',
            )
        );
        // var_dump($wpdb->queries);
        // var_dump($result);
        return $result;
    }
    public function showPagenation()
    {
        echo '
        <ul class="pagination" role="menubar" aria-label="Pagination">
            <li class="first"><a href="#" data-value="1"><span>First</span></a></li>
            <li class="previous"><a href="#" data-value="1"><span>Previous</span></a></li>
            <li class="current" data-value="1"><a>1</a></li>
            <li><a href="#" class="inactive" data-value="2">2</a></li>
            <li><a href="#" class="inactive" data-value="3" >3</a></li>
            <li class="next" data-value="4"><a href="#"><span>Next</span></a></li>
            <li class="last" data-value="4"><a href="#"><span>Last</span></a></li>
        </ul>
        ';
    }
}
