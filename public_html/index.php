<?php
/**
 * Created by PhpStorm.
 * User: ByoungOk
 * Date: 2017-10-27
 * Time: 오후 12:51
 */

include_once 'controller/Contoroller.php';

$contorller = new Contoroller();
$contorller->prtPage();

if(isset($_GET['play'])){
    switch($_GET['play']){
        case 'register':
            $contorller->register();
            break;
        case 'modify':
            $contorller->modify();
            break;
        case 'delete':
            $contorller->delete();
            break;
        case 'list':
            $contorller->prtList();
            break;
        case 'modify':
            $contorller->modify();
        default:
            break;
    }

}



?>