<?php
/**
 * Created by PhpStorm.
 * User: ByoungOk
 * Date: 2017-11-02
 * Time: 오후 8:21
 */

include_once 'Model.php';

$model = new Model();

$inputKeyword = $_GET['inputKeyword'];

$sql = "select * from userinfo where userid like '$inputKeyword'";

$myObj = mysqli_fetch_array($model->sendQuery($sql));

$myObj = json_encode($myObj);


print_r($myObj);
?>