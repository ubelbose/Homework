<?php
/**
 * Created by PhpStorm.
 * User: ByoungOk
 * Date: 2017-10-27
 * Time: 오후 12:46
 */

include_once 'dbLoginData.php';
class Model{

function connectDB(){
    $db_handler = mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
    return $db_handler;
}

function sendQuery($sql){
    $db_handler = $this->connectDB();
    $result = mysqli_query($db_handler,$sql);
    return $result;
}
}