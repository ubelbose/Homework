<?php
/**
 * Created by PhpStorm.
 * User: ByoungOk
 * Date: 2017-10-27
 * Time: 오후 12:45
 */

include_once 'model/Model.php';

class Contoroller {

    public $modelObj;

public function __construct()
{
    $this->modelObj = new Model();
}

public function prtPage(){

    if(!isset($_GET['mode'])){
        include 'view/main.html';
    }
    else if($_GET['mode'] == 'list'){
        echo "<script>location.replace(\"http://localhost/index.php?play=list&page=0\")</script>";
    }
        else{
        include "view/".$_GET['mode'].".html";
    }
}

public function register(){

        $id = $_GET['user_id'];
        $pwd = $_GET['user_pwd'];
        $name = $_GET['user_name'];
        $class = $_GET['user_class'];
        $gender = $_GET['user_gender'];
        $phone = $_GET['user_phone'];
        $email = $_GET['user_email'];

        $sql = "select userid from userinfo where userid = '$id';";



    if(mysqli_num_rows($this->modelObj->sendQuery($sql)) == 0) {

        $sql = "insert into userinfo(userid,password,name,classification,gender,phone,email) values('$id','$pwd','$name','$class','$gender','$phone','$email');";

        $this->modelObj->sendQuery($sql);

        echo "<script>alert('회원 등록에 성공했습니다');location.replace('/')</script>";


    }
    else{
        echo "<script>alert('이미 존재하는 ID입니다');location.replace('http://localhost/index.php?mode=register')</script>";

    }

}//regiser-end

    public function modify(){
        $id = $_GET['user_id'];
        $pwd = $_GET['user_pwd'];
        $name = $_GET['user_name'];
        $class = $_GET['user_class'];
        $gender = $_GET['user_gender'];
        $phone = $_GET['user_phone'];
        $email = $_GET['user_email'];

        $sql = "update userinfo set userid = '$id', password = '$pwd', name = '$name', classification = '$class', gender= '$gender', phone = '$phone', email = '$email' where userid like '$id';";
        $this->modelObj->sendQuery($sql);
        $this->modelObj->sendQuery('commit;');

        echo "<script>alert(\"수정되었습니다.\");location.replace('/');</script>";


    }


    public function delete(){

    $user_id = $_GET['user_id'];
    $user_pwd = $_GET['user_pwd'];

    $access_excption = false;

    $sql = "select password from userinfo where userid = '$user_id'";
    if(mysqli_num_rows($this->modelObj->sendQuery($sql)) == 0){
        echo "<script>alert('존재하지 않는 ID입니다.');</script>";
        $access_excption = true;
    }
    else if(mysqli_fetch_array($this->modelObj->sendQuery($sql))[0] != $user_pwd){

        echo "<script>alert('패스워드가 일치하지 않습니다.');</script>";
        $access_excption = true;
    }

    if(!$access_excption){
        $sql = "delete from userinfo where userid = '$user_id'";
        $this->modelObj->sendQuery($sql);

        echo "<script>alert('성공적으로 처리하였습니다');location.replace('/');</script>";
    }
    else{

        echo "<script>location.replace('http://localhost/index.php?mode=delete');</script>";
    }
    }//delete-end

    public function prtList(){
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page++;
        $page_start = isset($_GET['page_start']) ? $_GET['page_start'] : 0;
        $page_start = ($page-1) * 5;
        $page_end = $page_start+5;

        $sql = "select * from userinfo limit $page_start, $page_end";

        $result_num_rows = mysqli_fetch_array($this->modelObj->sendQuery('select count(*) from userinfo'))[0];
        echo "<div id='user_list'>";
        include 'view/list.html';
        echo "</div>";
        echo "<input type=button onclick='location.replace(\"/\")' value='지우기'>";



    }



}



?>