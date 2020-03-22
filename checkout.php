<?php
	$titre="Checkout";
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
    		    header('Location: login');
    	}
	}
	include_once('inc/nav.php');
?>
    <div class="container">
      <div class="row mt-3">
        <div class="col-lg-6 order-md-1 offset-lg-3">
          <h4 class="mb-3">Adresse de shippement</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="firstName">Nom complet</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="vous@exemple.ma" required>
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
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Carte de crédit / débit</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">Paypal</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-2">
                <label for="cc-name">Nom sur la carte</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
              </div>
              <div class="col-md-6 mb-2">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-2">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              </div>
              <div class="col-md-3 mb-2">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              </div>
            </div>
            <hr class="mb-2">
            <button class="btn btn-primary btn-block" type="submit">Continue au checkout</button>
          </form>
        </div>
      </div>

    </div>
	<div class="py-5"></div>
    <?php include_once('inc/footer.php'); ?>