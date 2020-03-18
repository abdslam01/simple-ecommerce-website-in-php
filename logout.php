<?php
    session_start();
    session_unset();
    session_destroy();
    if(isset($_COOKIE['token']))
    setcookie("token",$_COOKIE['token'],time()-1);
    header('Location: index');
    exit;