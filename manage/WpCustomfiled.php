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
            foreach ($array as $value) {
                // var_dump($array);
                $result = add_post_meta($postId, $itemname, $value, false);
            }
            return true;
        }
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
    public function showCheckedItems($arrayItem, $kind)
    {
        if (in_array($kind, $arrayItem)) {
            return  'checked="CHECKED"';
        }
        return null;
    }
    /*
    画像アップロード部
    最後にreturn $aidでIDを返しても良い
    カスタムフィールドの画像のアップロード
    */
    function addCustomImage($post_id, $upload, $cfName)
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
                             wp_update_attachment_metadata($aid, wp_generate_attachment_metadata($aid, $file['file']));  /*If there is no error, update the metadata of the newly uploaded image*/
                    }
                }
            } else {
                // echo 'Please upload the image.';
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
}
