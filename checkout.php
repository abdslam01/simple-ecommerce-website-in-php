<?php
	$titre="Checkout";
  include_once('inc/header.php');
  $db=new db;
  $q="SELECT * FROM users where token='".$db->verifyAndReturn($_COOKIE['token'])."'";
  $result=$db->returnData($q,'one');
	if(!isset($_SESSION['user'])){
	    if(isset($_COOKIE['token'])){
    		if(empty($result)){
    		    session_unset();
    		    session_destroy();
    		    setcookie('token',$_COOKIE['token'],time()-1);
    		}else
    		    $_SESSION['user']=$result['username'];
	    }else{
    		    session_unset();
    		    session_destroy();
    		    header('Location: login');
    	}
	}
  include_once('inc/nav.php');
  $_SESSION['id']=$result['id'];
  $somme=intval($db->returnData("select sum(prix) as somme from panier where user_id=".$_SESSION['id'],'one')['somme']);
?>
    <div class="container content justify-content-center mb-5">
      <div class="row mt-3">
        <div class="col-lg-4 border border-primary h-100">
          <div>
            <h3>la récapitulation</h3>
          </div>
          <div class='<?= $somme==0 ?"d-none":""; ?>'>
            <ul class="list-group list-group-flush mb-1">
              <li class="list-group-item active">Prix: <b class="float-right">$<?= $somme; ?></b></li>
              <li class="list-group-item list-group-item-primary">T.V.A. (10%): <b class="float-right">$<?= $somme*0.1; ?></b></li>
              <li class="list-group-item list-group-item-primary">Prix ​​final: <b class="float-right">$<?= $somme*1.1; ?></b></li>
            </ul>
          </div>
          <div class='<?= $somme!=0 ?"d-none":""; ?>'>
            <ul class="list-group list-group-flush mb-1">
              <li class="list-group-item active">
                <b>Pas De Produits Actuellement</b>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-7 order-md-1">
          <h4 class="mb-3">Adresse de shippement</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="firstName">Nom complet</label>
                <input type="text" value="<?= $result['username']; ?>" class="form-control" id="firstName" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" value="<?= $result['email']; ?>" class="form-control" id="email" placeholder="vous@exemple.ma" required>
            </div>

            <div class="mb-3">
              <label for="address">Adresse</label>
              <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Pays</label>
                <select class="custom-select d-block w-100" id="country" required>
                  <option value="">Choisissez...</option>
                  <?php
                    include_once('inc/countries.php');
                    foreach($countries as $c)
                        echo "<option>$c</option>";
                  ?>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">Ville</label>
				        <input type="text" class="form-control" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="" required>
              </div>
            </div>

            <hr class="mb-4">

            <h4 class="mb-3">Paiement</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" value=credit name="paymentMethod" type="radio" class="custom-control-input" checked=checked required>
                <label class="custom-control-label" for="credit">Carte de crédit / débit</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" value=paypal name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">Paypal</label>
              </div>
            </div>
            <div class="credit">
              <div class="row">
                <div class="col-md-6 mb-2">
                  <label for="cc-name">Nom sur la carte</label>
                  <input type="text" class="form-control" id="cc-name" required>
                </div>
                <div class="col-md-6 mb-2">
                  <label for="cc-number">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number"required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-2">
                  <label for="cc-expiration">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" required>
                </div>
                <div class="col-md-3 mb-2">
                  <label for="cc-expiration">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" required>
                </div>
              </div>
              </div>
              <div class="paypal">
                <div class="row">
                  <div class="text-center">
                    <h4>Vous serez redicter vers la page de paypal pour effectuer la payment</h4>
                  </div>
                </div>
              </div>
            <hr class="mb-2">
            <button class="btn btn-primary btn-block" type="submit">Continue au checkout</button>
          </form>
        </div>
      </div>

    </div>

    <?php include_once('inc/footer.php'); ?>