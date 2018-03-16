<?php

namespace Manage;

/*
wpの関数がロード状態であるこ必須。
カスタムフィールド関連
 */
class WpCustomfiled
{
    public function __construct()
    {
    }

    /**
     * カスタムフィールドを追加・更新・削除する。
     * @param  [type] $postId   [description]
     * @param  [type] $itemname [description]
     * @param  [type] $value    [description]
     * @return [type]           [description]
     */
    public function saveCustomPost($postId, $itemname, $value)
    {
        if (get_post_meta($postId, $itemname) == "") {
            $result = add_post_meta($postId, $itemname, $value, true);
        } elseif ($value != get_post_meta($postId, $itemname, true)) {
            $result = update_post_meta($postId, $itemname, $value);
        } elseif ($value == "") {
            $result = delete_post_meta($postId, $itemname, get_post_meta($postId, $itemname, true));
        }
            return $result;
    }
    /**
     * arrayのフィールドを保存する。基本削除後、登録
     * @param  [type] $postId   [description]
     * @param  [type] $itemname [description]
     * @param  [type] $value    [description]
     * @return [type]           [description]
     */
    public function saveCustomPosts($postId, $itemname, $array)
    {
        /**
         *  $post_id
         *      （整数） （必須） 削除したいカスタムフィールドを持つ投稿の ID。
         *                      初期値： なし
         * $meta_key
         *    （文字列） （必須） 削除したいカスタムフィールドのキー。
         *      初期値： なし
         * $meta_value
         *    （mixed） （オプション） 削除したいカスタムフィールドの値。これは、同じキーを持つカスタムフィールドを区別するパラメータです。省略すると、指定したキーを持つカスタムフィールドはすべて削除されます。
         *    初期値： ''
         * @var [type]
         */
        $result = delete_post_meta($postId, $itemname, "");
        if (is_array($array)) {
            $result = add_post_meta($postId, $itemname, $array, false);
            // var_dump($result);
            foreach ($array as $value) {
                // var_dump($array);
            }
            return true;
        }
        return null;
    }
    /**
     *  値をグループとして保存、可変OK　acf対応
     * @param  [type] $pstId    [投稿ID]
     * @param  [type] $groupKind ["interviewなど"]
     * @param  [type] $itemArr1 [登録する配列]
     * @return [type]           [description]
     */
    public function saveCustomPostsGroup($postId, $groupKind, $itemArr)
    {
        $count = get_post_meta($postId, $groupKind, true);//単一の値　false:array
        $count = 3;
        $rstDel[] = delete_post_meta($postId, "_".$groupKind, "");
        $rstDel[] = delete_post_meta($postId, $groupKind, "");
        foreach ($itemArr as $key => $value) {
            // var_dump($count);
            for ($i=0; $i < $count; $i++) {
                // var_dump($key,$i,$groupKind);
                $itemName = null;
                $itemName = $groupKind."_".$i."_Group_".$key;
                $rstDel[] = delete_post_meta($postId, $itemName, "");
                $itemName = "_".$groupKind."_".$i."_Group_".$key;
                $rstDel[] = delete_post_meta($postId, $itemName, "");
                $itemName = $groupKind."_".$i."_Group";
                $rstDel[] = delete_post_meta($postId, $itemName, "");
                $itemName = "_".$groupKind."_".$i."_Group";
                $rstDel[] = delete_post_meta($postId, $itemName, "");
            }
        }
        foreach ($itemArr as $key => $value) {
            // var_dump($count);
            for ($i=0; $i < $count; $i++) {
                // var_dump($key,$i,$groupKind);
                $itemName = null;
                $itemName = $groupKind."_".$i."_Group_".$key;
                $rstDel[] = add_post_meta($postId, $itemName, $value[$i], false);
                // $itemName = "_".$groupKind."_".$i."_Group_".$key;
                $itemName = $groupKind."_".$i."_Group";
                $rstDel[] = add_post_meta($postId, $itemName, "", false);
                // $itemName = "_".$groupKind."_".$i."_Group";
            }
        }
        add_post_meta($postId, $groupKind, $count, false);
        // var_dump($postId,$count,$rstDel,$itemArr,$itemName);
        // var_dump($value);
        return null;
    }
    /**
     * post_statusを上書きする。ステータスphp -S localhost:8000
     * @param  [type] $postId [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function savePostStatus($postId, $status)
    {
        $post = get_post($postId);
        $post->post_status = $status;
        $post->edit_date = true;
        $postId = wp_update_post($post);
        return $postId;
    }
    public function showSelectedPostStatus($status, $kind)
    {
        if ($kind == $status) {
            return  "SELECTED";
        }
        return null;
    }
    public function showCheckedItems($serialize, $kind)
    {
        $arrayItem = unserialize($serialize[0]);
        if (isset($arrayItem)) {
            if (in_array($kind, $arrayItem)) {
                return  'checked="CHECKED"';
            }
        }
        return null;
    }
    /*
    画像アップロード部
    最後にreturn $aidでIDを返しても良い
    カスタムフィールドの画像のアップロード
    */
    function saveCustomImage($post_id, $upload, $cfName)
    {
        //frontでもメディア関係が使えるように
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        $uploads = wp_upload_dir(); /*Get path of upload dir of wordpress*/

        if (is_writable($uploads['path'])) {  /*Check if upload dir is writable*/
            if ((!empty($upload['tmp_name']))) {  /*Check if uploaded image is not empty*/
                if ($upload['tmp_name']) {   /*Check if image has been uploaded in temp directory*/
                    $file = $this->handleImageUpload($upload); /*Call our custom function to ACTUALLY upload the image*/

                    $attachment = array  /*Create attachment for our post*/
                    (
                      'post_mime_type' => $file['type'],  /*Type of attachment*/
                      'post_parent' => $post_id,  /*Post id*/
                       );

                       $aid = wp_insert_attachment($attachment, $file['file'], $post_id);  /*Insert post attachment and return the attachment id*/
                       $a = wp_generate_attachment_metadata($aid, $file['file']);  /*Generate metadata for new attacment*/
                       $prev_img = get_post_meta($post_id, $cfName);  /*Get previously uploaded image*/
                    if (is_array($prev_img)) {
                        if ($prev_img[0] != '') {  /*If image exists*/
                              wp_delete_attachment($prev_img[0]);  /*Delete previous image画像が増えていかないように*/
                        }
                    }
                       $rst = update_post_meta($post_id, $cfName, $aid);  /*Save the attachment id in meta data適当なフィールド名で！*/
                       // var_dump($rst);

                    if (!is_wp_error($aid)) {
                             $result = wp_update_attachment_metadata($aid, wp_generate_attachment_metadata($aid, $file['file']));  /*If there is no error, update the metadata of the newly uploaded image*/
                            return $result;
                    }
                }
            } else {
                // echo 'Please upload the image.';
            }
        }
    }
    /**
     * 画像を複数保存する。Adbance Custom Filedsに対応
     */
    function saveCustomImages($postId, $uploadArr, $cfName)
    {
        try {
            // var_dump($uploadArr);
            $rstImgArr = array();
            /*uploadするために整形する。*/
            foreach ($uploadArr as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    $rstImgArr[$key2][$key] = $value2;
                }
            }
            // var_dump($rstImgArr);
            foreach ($rstImgArr as $key3 => $value3) {
                $rst[] = $this->saveImage($postId, $value3);
            }
            $item = get_post_custom($postId);
            $serializeImg = $item[$cfName];
            // var_dump($serializeImg);
            $imgArr = array();
            if ($serializeImg[0]) {
                $imgArr = unserialize($serializeImg[0]);
            }
            // var_dump($imgArr);
            // var_dump($rst);
            // foreach ($rst as $key => $value) {
            //     if ($imgArr[$key]) {
            //         if ($imgArr[$key] != '') {  /*If image exists*/
            //         }
            //     }
            // }
            //新しいイメージをシリアライズして保存
            foreach ($rst as $key => $value) {
                if ($value) {
                    //前のイメージを削除
                    wp_delete_attachment($imgArr[$key]);  /*Delete previous image画像が増えていかないように*/
                    $imgArr[$key] = $value;
                }
            }
            /**$imgArr　arrayのままで勝手にシリアライズ化してくれる
            **/
            $rst = update_post_meta($postId, $cfName, $imgArr);
            // var_dump($sirializeImg);
        } catch (\Exception $e) {
        }
    }
    /**
     * シンプルに画像をアップし、画像IDを返す。
     * @param  [type] $post_id [description]
     * @param  [type] $upload  [description]
     * @return [type]          [description]
     */
    function saveImage($postId, $upload)
    {
        //frontでもメディア関係が使えるように
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        $uploads = wp_upload_dir(); /*Get path of upload dir of wordpress*/

        if (is_writable($uploads['path'])) {  /*Check if upload dir is writable*/
            if ((!empty($upload['tmp_name']))) {  /*Check if uploaded image is not empty*/
                if ($upload['tmp_name']) {   /*Check if image has been uploaded in temp directory*/
                    $file = $this->handleImageUpload($upload); /*Call our custom function to ACTUALLY upload the image*/

                    $attachment = array  /*Create attachment for our post*/
                    (
                      'post_mime_type' => $file['type'],  /*Type of attachment*/
                      'post_parent' => $postId,  /*Post id*/
                       );

                       $aid = wp_insert_attachment($attachment, $file['file'], $postId);  /*Insert post attachment and return the attachment id*/
                       return $aid;
                }
            }
        }
    }
    function handleImageUpload($upload)
    {
        global $post;

        if ($this->isImageFile($upload['tmp_name'])) { /*Check if image*/
            /*handle the uploaded file*/
            $overrides = array('test_form' => false);
            $file=wp_handle_upload($upload, $overrides);
        }
        return $file;
    }

    //画像がどうか調べる。wpオリジナルの関数もある
    function isImageFile($file_path)
    {

        //まずファイルの存在を確認し、その後画像形式を確認する
        if (file_exists($file_path) && exif_imagetype($file_path)) {
            return true;
        } else {
            return false;
        }
    }
    public function getImageUrl($imgNum)
    {
        $imgUrl = null;
        try {
            $imgUrl = wp_get_attachment_image_src($imgNum, "full");
        } catch (\Exception $e) {
        }
        return $imgUrl[0];
    }
    /**
     * 複数の画僧を取得
     * @param  [type] $sirializeImg [画像IDがはいった配列　シリアライズされているa:2:{i:0;s:1:"a";i:1;s:1:"b";}]
     * @return [type]               [画像のURLがはいった配列]
     */
    public function getImagesUrl($sirializeImg)
    {
        $resultArr = null;
        try {
            $array = unserialize($sirializeImg[0]);
            // var_dump($sirializeImg);
            if (is_array($array)) {
                foreach ($array as $key => $value) {
                    $resultArr[$key] = $this->getImageUrl($value);
                }
            }
        } catch (\Exception $e) {
        }
        return $resultArr;
    }
    public function getImagesId($sirializeImg)
    {
        $resultArr = null;
        try {
            $resultArr = unserialize($sirializeImg[0]);
        } catch (\Exception $e) {
        }
        return $resultArr;
    }
    /**
     * dropzoneの背景画像の表示
     * @param  [type] $imgUrl [description]
     * @return [type]         [description]
     */
    public function theDropzoneBackimage($imgId)
    {
        if (!isset($imgId)) {
            return null;
        }
        $imgUrl = $this->getImageUrl($imgId);
        echo '<button class="dropButton" data-value="enable"><i class="fa fa-trash"></i></button>
        <div class="dropImages" style="background-image: url(\''.$imgUrl.'\');"></div>';
    }
}
