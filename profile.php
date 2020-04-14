<?php
    $titre="Profile";
    include_once('inc/header.php');
    $db=new db;

    $q="SELECT * FROM users where token='".$db->verifyAndReturn($_COOKIE['token'])."'";
    $result=$db->returnData($q,'one');
    if(!isset($_SESSION['user'])){
        if(isset($_COOKIE['token'])){
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

<?php if(isset($_POST['update'])){ ?>
<div class="container mt-3 content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="updateUserData" method="post">
				<div class="form-group">
					<label for="">Nom d'utilisateur: </label>
					<input type="text" name=user value="<?= $result['username']; ?>" class="form-control border-bottom-sucess" autocomplete="off">
                </div>
                <div class="form-group">
					<label for="">Nom Complet: </label>
					<input type="text" name=fname value="<?= $result['fname']; ?>" class="form-control border-bottom-sucess" autocomplete="off">
                </div>
                <div class="form-group">
					<label for="">Numéro de telephone: </label>
					<input type="text" name=number value="<?= $result['number']; ?>" class="form-control border-bottom-sucess" autocomplete="off">
                </div>
                <div class="form-group">
					<label for="">Email: </label>
					<input type="text" name=email value="<?= $result['email']; ?>" class="form-control border-bottom-sucess" autocomplete="off">
				</div>
				<div class="form-group">
					<label for="">Mot de passe: </label>
                    <input type="password" name=pass placeholder="Laisser cet input vide pour garder votre mot de passe" class="form-control border-bottom-sucess">
                    <input type="hidden" name="oldpass" value="<?= $result['password']; ?>">
                    <input type="hidden" name="id" value="<?= $result['id']; ?>">
				</div>
				<div class="form-group">
					<input type="submit" name=updateUser class="btn btn-dark" value="Mise à jout">
				</div>
			</form>
        </div>
    </div>
</div>
<?php }else{ ?>
<div class="container mt-3 content">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <?php if(isset($_SESSION['updated'])){
                        if($_SESSION['updated']) echo "<div class='alert alert-success'><b>Donées Modifier Avec Succés</b></div>";
                        else echo "<div class='alert alert-danger'><b>Donées Ne Sont Pas Modifer, SVP réessayez</b></div>";
                        unset($_SESSION['updated']);
                    } ?>
                <div class="card-body text-center">
                    <h4 class="card-title">Bonjour <?=$result['username']; ?></h4>
                    <div class="text-center">
                        <img src="img/avatar-man.png" alt="avatar par defaut" class="img-thumbnail" style="max-width:40%">
                    </div>
                    <p class="card-text"><?= $result['email']; ?></p>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <form method=post action="<?= explode('.',$_SERVER['PHP_SELF'])[0]; ?>">
                            <button type="submit" name=update class="btn btn-sm btn-outline-warning">modifer le profile</button>
                        </form>
                        <form action="updateUserData" method="post" class="ml-2">
                            <input type="submit" name=deleteUser class="btn btn-sm btn-outline-danger" value="Supprimer Votre Compte" onclick="return confirm('Est-ce-que Vous êtes sûr?');">
                            <input type="hidden" name="id" value="<?= $result['id']; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include_once('inc/footer.php');?>