<<<<<<< HEAD
<?php
if (!is_user_logged_in()) {
    wp_redirect("/stg.yoga-gene.com/login/");
}
?><?php //include_once( dirname(__FILE__) . '/community-admin/function/function.php');   ?>
=======
<?php //include_once( dirname(__FILE__) . '/community-admin/function/function.php'); ?>
>>>>>>> parent of 4bb3e39... 0313
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="<?= WORKSPACE2 ?>css/bootstrap.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="<?= WORKSPACE2 ?>vendors/jquery/dist/jquery.min.js"></script>
        <!-- Font Awesome -->
        <link href="<?= WORKSPACE2 ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <link href="<?= WORKSPACE2 ?>vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

        <link href="<?= WORKSPACE2 ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="<?= WORKSPACE2 ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="<?= WORKSPACE2 ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?= WORKSPACE2 ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <link href="<?= WORKSPACE2 ?>vendors/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
        <link href="<?= WORKSPACE2 ?>vendors/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?= WORKSPACE2 ?>vendors/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">

        <link href="<?= WORKSPACE2 ?>test/lib/hiraku/hiraku.css" rel="stylesheet">
        <link href="<?= WORKSPACE2 ?>test/lib/animsition/css/animsition.min.css" rel="stylesheet">
        <link href="<?= WORKSPACE2 ?>css/test/test.css" rel="stylesheet">
        <link href="<?= WORKSPACE2 ?>css/custom.css" rel="stylesheet">
    </head>
    <body>
        <div class="animsition">
            <div class="mypage">
                <?php //require_once( WORKSPACE . 'include/left.php' ); ?>
                <?php get_sidebar('admin'); ?>
                <main class="main">
                    <?php //exit(); ?>
