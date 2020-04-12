<?php
if($_SERVER['REQUEST_METHOD']!=='POST'){
    header('Location: index');
    exit;
}

session_start();
ob_start();
require_once('inc/db.php');
$db=new db;

$q="update users set username=?, email=?, password=? where id=?";
$pass = !empty($_POST['pass']) ? sha1($_POST['pass'].SALT) : $_POST['oldpass'];
if($db->updateData($q, [$_POST['user'], $_POST['email'], $pass, $_POST['id']]))
    $_SESSION['updated']="<div class='alert alert-success'><b>Donées Modifier Avec Succés</b></div>";
else
    $_SESSION['updated']="<div class='alert alert-danger'><b>Donées Ne Sont Pas Modifer, SVP réessayez</b></div>";

unset($_SESSION['user']);
$_SESSION['user']=$_POST['user'];
header('Location: profile');