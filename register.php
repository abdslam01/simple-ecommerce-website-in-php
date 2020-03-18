<?php
	$titre="Enregistrement";
	include_once('inc/header.php');
	if(isset($_SESSION['user'])){
		header('Location: index');
		exit;
	}elseif(isset($_COOKIE['token'])){
		$q="select * from users where token='".verifyAndReturn($_COOKIE['token'])."' limit 1";
		$stmt = $mysqli->stmt_init();
		$stmt->prepare($q);
		$stmt->execute();
		$result=$stmt->get_result();
		if($result){
			$arr=$result->fetch_assoc();
			$_SESSION['user']=$arr['username'];
			header('Location: index');
			exit;
		}
	}
	if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD']=='POST'){
		$d=[
			'user'=>verifyAndReturn($_POST['user']),
			'email'=>verifyAndReturn($_POST['email']),
			'pass'=>verifyAndReturn($_POST['pass']),
			'pass2'=>verifyAndReturn($_POST['pass2']),
			'token'=>generateToken()
		];
		$errors=[];
		if(empty($d['user'])) $errors['user']="User ne doit pas etre vide";
		if(empty($d['email'])) $errors['email']="Email ne doit pas etre vide";
		if(empty($d['pass'])) $errors['pass']="Mot de pass est requet ne doit pas etre vide";
		else if($d['pass'] != $d['pass2']) $errors['pass2']="Mot de passe doit etre la meme";

		if(empty($errors)){
			$tmp=sha1($d['pass'].SALT);
			$sql="INSERT INTO users VALUES(0, '${d['user']}', '${d['email']}', '$tmp', '${d['token']}')";
			$stmt=$mysqli->query($sql);
			if($stmt){
				setcookie("token",$d['token'],time()+24*3600);
				$_SESSION['logged']=$_COOKIE['token'];
				$_SESSION['user']=$d['user'];
				header('Location: index');
				exit;
			}else{
				$errors['warn']="il y a un erreur de system, svp ressayer";
			}
		}
	}
	include_once('inc/nav.php');
?>
	<div class="container">
		<div class="col-lg-8 offset-lg-2 mt-3">
			<form action="<?php echo explode(".",$_SERVER['PHP_SELF'])[0]; ?>" method="post">
				<?php if(isset($errors['warn'])){ ?>
					<div class="alert alert-warning">
						<?php echo $errors['warn']; ?>
					</div>
				<?php } ?>
				<div class="form-group">
					<label for="">Nom d'utilisateur: </label>
					<input type="text" name=user class="form-control border-bottom-info" required autocomplete="off">
				</div>
				<?php if(isset($errors['user'])){ ?>
					<div class="alert alert-danger">
						<?php echo $errors['user']; ?>
					</div>
				<?php } ?>
				<div class="form-group">
					<label for="">Email: </label>
					<input type="email" name=email class="form-control border-bottom-info" required autocomplete="off">
				</div>
				<?php if(isset($errors['email'])){ ?>
					<div class="alert alert-danger">
						<?php echo $errors['email']; ?>
					</div>
				<?php } ?>
				<div class="form-group">
					<label for="">Mot de passe: </label>
					<input type="password" name=pass class="form-control border-bottom-info" required>
				</div>
				<?php if(isset($errors['pass'])){ ?>
					<div class="alert alert-danger">
						<?php echo $errors['pass']; ?>
					</div>
				<?php } ?>
				<div class="form-group">
					<label for="">Confirmer le mot de passe: </label>
					<input type="password" name="pass2" class="form-control border-bottom-info" required>
				</div>
				<?php if(isset($errors['pass2'])){ ?>
					<div class="alert alert-danger">
						<?php echo $errors['pass2']; ?>
					</div>
				<?php } ?>
				<div class="form-group">
					<input type="submit" name=submit class="btn btn-info btn-block" value="Enregister">
				</div>
			</form>
		</div>
	</div>
<?php include_once('inc/footer.php'); ?>