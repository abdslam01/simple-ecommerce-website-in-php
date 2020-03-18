<?php
require_once('inc/header.php');
require_once('inc/nav.php')
?>
<div class="container">
		<div class="row">
			
			<div class="col-md-4 col-sm-12">
				<img class="img-thumbnail" src="http://bahafid.000webhostapp.com/img/black-laptop.jpg">
			</div>
			<div class="col-md-8 col-sm-12">
				<h2>Ordinateur Portable</h2>
                    <p>ici on va mettre dans ces "tabs" les details de nos produits</p>
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="pill" href="#home" class="active">Détails</a></li>
                        <li><a data-toggle="pill" href="#menu1" class="">Livraison</a></li>
                    </ul>
  
                <div class="tab-content">
                <div id="home" class="tab-pane fade in active show">
                <h3>Détails</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Livraison</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
	
  </div>
				
			</div>
		</div>
	</div>
<?php
require_once('inc/footer.php')
?>