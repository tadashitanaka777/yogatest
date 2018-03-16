<?php
    define('WORKSPACE','/home/ubuntu/workspace/');
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
?>