<!--<div class='container'>-->
<section id="slider" class="carousel slide" data-ride="carousel" data-duration="500" data-interval="4000">
		<div class="carousel-inner" style="height: 100%">
			<?php
				$slideProducts=[
					['black-laptop.jpg', 3500, 'Ordinateur portable','active'],
					['phone.png', 2000, 'Smartphone'],
					['headphones.png', 120, 'écouteurs']
				];
				foreach($slideProducts as $produit){
			?>
				<div class="carousel-item <?= isset($produit['3'])?'active':''; ?>">
					<img class="slide" src="img/<?=$produit[0];?>">
					<div class="fw_al_001_slide">
						<h3 data-animation="animated fadeInUp">just à <?=$produit[1];?> DHs</h3>
						<h1 data-animation="animated fadeInUp"><?=$produit[2];?></h1>
						<p data-animation="animated fadeInUp">profiter de notre promotion</p><a href="#" data-animation="animated fadeInUp"><button class="btn btn-lg btn-primary">acheter maintenant</button></a>
					</div>	
				</div>
			<?php } ?>
			<a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon bg-primary" aria-hidden="true"></span>
			</a>
			<a class="carousel-control-next" href="#slider" role="button" data-slide="next">
				<span class="carousel-control-next-icon bg-primary" aria-hidden="true"></span>
			</a>
		</div>
	</section>
	<!--</div>-->