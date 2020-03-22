<?php 
	$titre="Principale";
	include_once('inc/header.php');
	if(!isset($_SESSION['user'])){
	    if(isset($_COOKIE['token'])){
    	    $q="SELECT * FROM users where token='".verifyAndReturn($_COOKIE['token'])."'";
    		$stmt = $mysqli->stmt_init();
    		$stmt->prepare($q);
    		$stmt->execute();
    		$result=$stmt->get_result()->fetch_assoc();
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
	include_once('inc/slider.php');
?>
	<div class="container">
		<div class="row">
		    <?php
		    $q="SELECT * from produits";
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($q);
            $stmt->execute();
            $arr=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			    foreach($arr as $elem){ ?>
				<div class="col-xl-4 col-md-6 col-sm-12">
					<div class="card mb-4 shadow-sm">
						<img src="<?php echo $elem['image']; ?>" alt="" srcset="" class="card-img-top pic">
						<div class="card-body">
						<h4 class="card-title"><?php echo $elem['title']; ?></h4>
						<small class="text-muted"><?php echo $elem['prix']; ?> Dhs</small>
						
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
								    <form action=panier method=post>
								        <input type=hidden name=data value="<?php echo  $elem['title'].','. $elem['prix'].','. $elem['image']; ?>">
								        <button type="submit" name=submit class="btn btn-sm btn-outline-warning"><i class="fas fa-shopping-cart"> Ajouter</i></button>
								    </form>
									<a href="/produit"><button type="button" class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i> Details</button></a>
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