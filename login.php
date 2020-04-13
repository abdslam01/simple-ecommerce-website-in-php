<?php
	$titre="Authentification";
	include_once('inc/header.php');
	$db=new db;
	if(isset($_SESSION['user'])){
		header('Location: index');
 		exit;
	}elseif(isset($_COOKIE['token'])){
		$q="select * from users where token='".$db->verifyAndReturn($_COOKIE['token'])."' limit 1";
		$result=$db->returnData($q,'one');
		if(!empty($result)){
			$_SESSION['user']=$result['username'];
    		header('Location: index');
     		exit;
		}
	}
	if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD']=='POST'){
		$d=[
			'user'=>$db->verifyAndReturn($_POST['user']),
			'pass'=>$db->verifyAndReturn($_POST['pass'])
		];
		$errors=[];
		if(empty($d['user'])) $errors['user']="entrer votre nom d'utlisatuer s'il vous plait";
		if(empty($d['pass'])) $errors['pass']="entrer votre mot de passe s'il vous plait";
		
		if(empty($errors)){
			$tmp=sha1($d['pass'].SALT);
			$q="SELECT * FROM users where username='${d['user']}' and password='$tmp'";
			$result=$db->returnData($q,'one');
			if($result){
				setcookie("token",$result['token'],time()+24*3600);
				$_SESSION['logged']=$result['token'];
				$_SESSION['user']=$result['username'];
				$_SESSION['id']=$result['id'];
        		header('Location: index');
         		exit;
			}else{
				$_SESSION['userTmp']=$d['user'];
				$errors['user']="le nom d'utlisateur ou le  mot de pass est invalide";
			}
		}
	}
	include_once('inc/nav.php');
?>
	<div class="container content">
		<div class="col-lg-8 offset-lg-2 mt-3">
		    <?php if(isset($_SESSION['visiteur'])){ ?>
		        <div class="alert alert-warning">
		            SVP, connecter pour que vous puissent inserer les produits au panier ou <a herf=login><button class="btn btn-info btn-sm float-right">Cree un compte</button></a>
		        </div>
		    <?php unset($_SESSION['visiteur']); } ?>
			<form action="<?php echo explode(".",$_SERVER['PHP_SELF'])[0]; ?>" method="post">
				<div class="form-group">
					<label for="">Nom d'utilisateur: </label>
					<input type="text" value="<?php if(isset($_SESSION['userTmp'])){echo $_SESSION['userTmp'];unset($_SESSION['userTmp']);}?>" name=user class="form-control border-bottom-sucess" autocomplete="off">
				</div>
				<?php if(isset($errors['user'])){ ?>
					<div class="alert alert-danger">
						<?= $errors['user']; ?>
					</div>
				<?php } ?>
				<div class="form-group">
					<label for="">Mot de passe: </label>
					<input type="password" name=pass class="form-control border-bottom-sucess">
				</div>
				<?php if(isset($errors['pass'])){ ?>
					<div class="alert alert-danger">
						<?= $errors['pass']; ?>
					</div>
				<?php } ?>
				<div class="form-group">
					<input type="submit" name=submit class="btn btn-success btn-block" value="S'indentifier">
				</div>
			</form>
		</div>
	</div>
<?php include_once('inc/footer.php'); ?>