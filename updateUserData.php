<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    session_start();
    ob_start();
    require_once('inc/db.php');
    $db=new db;
    if(isset($_POST['updateUser'])){    
        $q="update users set username=?, fname=?, number=?, email=?, password=? where id=?";
        $pass = !empty($_POST['pass']) ? sha1($_POST['pass'].SALT) : $db->verifyAndReturn($_POST['oldpass']);
        if($db->updateData($q, [$db->verifyAndReturn($_POST['user']), $db->verifyAndReturn($_POST['fname']), $db->verifyAndReturn($_POST['number']), $db->verifyAndReturn($_POST['email']), $pass, $db->verifyAndReturn($_POST['id'])]))
            $_SESSION['updated']=true;
        else
            $_SESSION['updated']=false;
    
        $_SESSION['user']=$db->verifyAndReturn($_POST['user']);
        header('Location: profile');
        exit;
    }else if(isset($_POST['deleteUser'])){
        if($db->deleteData("delete from users where id=?", [$_POST['id']]))
            $_SESSION['deleted']=true;
        else
        $_SESSION['deleted']=false;
        header('Location: index');
        exit;
    }
}else{
    header('Location: index');
    exit;
}