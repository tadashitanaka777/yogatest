<?php
    define('WORKSPACE', get_template_directory()."/community-admin/");
    define('WORKSPACE2', "/stg.yoga-gene.com/wp-content/themes/yogagene/community-admin/");
    require_once(WORKSPACE.'function/class.php');
    require_once(WORKSPACE.'function/scriptClass.php');
    require_once(WORKSPACE.'function/dataClass.php');
    require_once(WORKSPACE.'function/jsonClass.php');
    require_once(WORKSPACE.'function/apiClass.php');
    $cdClass = new createData;
    $scClass = new scriptClass;
    $jsClass = new jsonClass;
    $dataClass = new dataClass;
    $apiClass = new apiClass;
