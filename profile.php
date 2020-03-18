<?php
    $titre="Profile";
    include_once('inc/header.php');
    if(!isset($_SESSION['user'])){
        if(isset($_COOKIE['token'])){
            $q="SELECT * FROM users where token='".verifyAndReturn($_COOKIE['token'])."'";
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($q);
            $stmt->execute();
            $result=$stmt->get_result()->fetch_assoc();
            if(empty($result)){
                header('Location: login');
                exit;
            }else{
                $_SESSION['user']=$result['username'];
            }
        }else{
            header('Location: login');
            exit;
        }
    }
    include_once('inc/nav.php');
?>

<!-- <div class="container">
    <pre><?php print_r($result); ?></pre>
</div> -->
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title">Bonjour <?php echo $result['username']; ?></h4>
                    <div class="text-center">
                        <img src="img/avatar-man.png" alt="avatar par defaut" srcset="" class="img-thumbnail" style="max-width:40%">
                    </div>
                    <p class="card-text"><?php echo $result['email']; ?></p>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <a href="#" class="btn btn-sm btn-outline-warning">modifer le profile</a>
                        <!--<a href="#" class="btn btn-sm btn-outline-danger">Acheter</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('inc/footer.php'); ?>