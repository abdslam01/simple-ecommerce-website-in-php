<?php
session_start(); 
	$titre="Authentification";
	include_once('inc/header.php');
	if($_SESSION['access']==="oui"){
		header('Location: index');
 		exit;
	}elseif(isset($_COOKIE['token'])){
		$stmt=$mysqli->stmt_init();
		$stmt->prepare("select * from users where token='".verifyAndReturn($_COOKIE['token'])."' limit 1");
		$stmt->execute();
		$result=$stmt->get_result()->fetch_assoc();
		if(!empty($result)){
			$_SESSION['user']=$result['username'];
			$_SESSION['access']="oui";
    		header('Location: index');
     		exit;
		}
	}
	if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD']=='POST'){
		$d=[
			'user'=>verifyAndReturn($_POST['user']),
			'pass'=>verifyAndReturn($_POST['pass'])
		];
		$errors=[];
		if(empty($d['user'])) $errors['user']="entrer votre nom d'utlisatuer s'il vous plait";
		if(empty($d['pass'])) $errors['pass']="entrer votre mot de passe s'il vous plait";

		if(empty($errors)){
			$tmp=sha1($d['pass'].SALT);
			$q="SELECT * FROM users where username='${d['user']}' and password='$tmp'";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($q);
			$stmt->execute();
			$result=$stmt->get_result()->fetch_assoc();
			if($result){
				setcookie("token",$result['token'],time()+24*3600);
				$_SESSION['logged']=$result['token'];
				$_SESSION['user']=$result['username'];
        		header('Location: index');
         		exit;
			}else{
				$errors['user']="le nom d'utlisateur ou le  mot de pass est invalide";
			}
		}
	}
	include_once('inc/nav.php');
?>
	<div class="container">
		<div class="col-lg-8 offset-lg-2 mt-3">
		    <?php if(isset($_GET['visiteur'])){ ?>
		        <div class="alert alert-warning">
		            SVP, connecter pour que vous puissent inserer les produits au panier<br>
		            ou <a herf=login><button class="btn btn-info">Cree un compte</button></a>
		        </div>
		    <?php } ?>
			<form action="<?php echo explode(".",$_SERVER['PHP_SELF'])[0]; ?>" method="post">
				<div class="form-group">
					<label for="">Nom d'utilisateur: </label>
					<input type="text" name=user class="form-control border-bottom-sucess" autocomplete="off">
				</div>
				<?php if(isset($errors['user'])){ ?>
					<div class="alert alert-danger">
						<?php echo $errors['user']; ?>
					</div>
				<?php } ?>
				<div class="form-group">
					<label for="">Mot de passe: </label>
					<input type="password" name=pass class="form-control border-bottom-sucess">
				</div>
				<?php if(isset($errors['pass'])){ ?>
					<div class="alert alert-danger">
						<?php echo $errors['pass']; ?>
					</div>
				<?php } ?>
				<div class="form-group">
					<input type="submit" name=submit class="btn btn-success btn-block" value="S'indentifier">
				</div>
			</form>
		</div>
	</div>
<?php include_once('inc/footer.php'); ?>