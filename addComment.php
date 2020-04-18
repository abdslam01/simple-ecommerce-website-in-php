<?php
include('inc/db.php');
if(isset($_POST['product_id'])&&isset($_POST['comment'])){
    $bd= new bd;
    $q="insert into commentaires values(NULL,?,?,?,NULL)";
    $arr=[$_POST['product_id'],$_SESSION['user'],$_POST['comment']];
    if($bd->insertData($q,$arr))
        header('location : produit?'.$_POST['produit_id']);
    else
        echo "erreur";
}
?>