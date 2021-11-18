<?php
session_start();
require_once('/word/Contorollers/Controller.php');
$Controller = new Controller();

$errors = $Controller->word_validate($_POST['shugo'],$_POST['jutugo']);
if(!empty($errors)){
    if(isset($errors['shugo'])){
        $_SESSION['shugo'] = $errors['shugo'];
    }
    if(isset($errors['jutugo'])){
        $_SESSION['jutugo'] = $errors['jutugo'];
    }
    echo json_encode($errors['shugo'] . $errors['jutugo']);
}else{
    $user_id = $Controller->select_id($_SESSION['name']);
    $Controller->shugo_insert($user_id,$_POST['shugo']);
    $Controller->jutugo_insert($user_id,$_POST['jutugo']);
    echo json_encode('登録成功');
}