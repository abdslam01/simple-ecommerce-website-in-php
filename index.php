<?php 
	$titre="Principale";
	include_once('inc/header.php');
	$db=new db;
	if(!isset($_SESSION['user'])){
	    if(isset($_COOKIE['token'])){
    	    $q="SELECT * FROM users where token='".$db->verifyAndReturn($_COOKIE['token'])."'";
    		$result=$db->returnData($q,'one');
    		if(empty($result)){
    		    session_unset();
    		    session_destroy();
    		    setcookie('token',$_COOKIE['token'],time()-1);
    		}else{
    		    $_SESSION['user']=$result['username'];
    		    $_SESSION['id']=$result['id'];
    		}
	    }else{
    		    session_unset();
    		    session_destroy();
    	}
	}
	include_once('inc/nav.php');

	if(isset($_SESSION['deleted'])){
		if($_SESSION['deleted']){
			echo "<div class='alert alert-success text-center'><b>Votre compte à été supprimer avec succés</b></div>";
			session_unset();
			session_destroy();
		}else echo "<div class='alert alert-danger text-center'><b>Erreur durant la suppression, SVP réessayez</b></div>";
		unset($_SESSION['deleted']);
	}

	include_once('inc/slider.php');
?>
	<div class="container">
		<div class="row">
			<div class="col-xl-4 col-md-6 col-sm-12">
				<div class="card mb-4 shadow-sm">
					<img src="img/rapport.jpg" class="card-img-top  pt-2">
					<div class="card-body">
						<h4 class="card-title">Le Rapport De Ce Projet</h4>
				    	<div class="d-flex justify-content-between align-items-center">
							<div class="btn-group">
							    <a href="Rapport/Rapport.pdf">
							        <button class="btn btn-sm btn-outline-info"><i class="fas fa-download"> Teléchager</i></button>
							    </a>
								<a href="MiniProjDetails.txt">
								    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-info-circle"></i> Details</button>
								</a>
							</div>
					    </div>
					</div>
				</div>
			</div>
		    <?php
			foreach($db->returnData("SELECT * from produits",'many') as $elem){ ?>
				<div class="col-xl-4 col-md-6 col-sm-12">
					<div class="card mb-4 shadow-sm">
						<img src="<?php echo $elem['image']; ?>" alt="" srcset="" class="card-img-top pic">
						<div class="card-body">
						<h4 class="card-title"><?php echo $elem['title']; ?></h4>
						<small class="text-muted"><?php echo $elem['prix']; ?> Dhs</small>
						
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
								    <form action=panier method=post>
								        <input type=hidden name=data value="<?=$elem['title'].','. $elem['prix'].','. $elem['image']; ?>">
								        <button type="submit" name=submit class="btn btn-sm btn-outline-warning"><i class="fas fa-shopping-cart"> Ajouter</i></button>
								    </form>
									<a href="produit?p=<?= $elem['id']; ?>"><button type="button" class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i> Details</button></a>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<br><br>
<?php include_once('inc/footer.php'); ?>