<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    session_start();
    ob_start();
    require_once('inc/db.php');
    $db=new db;

    $q="update users set username=?, email=?, password=? where id=?";
    $pass = !empty($_POST['pass']) ? sha1($_POST['pass'].SALT) : $db->verifyAndReturn($_POST['oldpass']);
    if($db->updateData($q, [$db->verifyAndReturn($_POST['user']), $db->verifyAndReturn($_POST['email']), $pass, $db->verifyAndReturn($_POST['id'])]))
        $_SESSION['updated']="<div class='alert alert-success'><b>Donées Modifier Avec Succés</b></div>";
    else
        $_SESSION['updated']="<div class='alert alert-danger'><b>Donées Ne Sont Pas Modifer, SVP réessayez</b></div>";

    $_SESSION['user']=$db->verifyAndReturn($_POST['user']);
    header('Location: profile');
}else{
    header('Location: index');
    exit;
}