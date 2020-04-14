<?php
$titre="produit";
require_once('inc/header.php');
require_once('inc/nav.php');
if(isset($_GET['p']) && is_numeric($_GET['p'])){
  $db=new db;
  $arr=$db->returnData("select * from produits where id=".$_GET['p'],'one');
  if(empty($arr)) header('Location: index');
}else
  header('Location: index');
?>
<div class="container content mt-3">
	<div class="row">
		<div class="col-md-4 col-sm-12">
				<img class="img-thumbnail" src="<?=$arr['image']?>">
        <hr class="bg-danger">
        <?php 
            if(isset($_POST['addComment']) && !empty($_POST['comment'])){
                if($db->insertData("insert into commentaires values(NULL,?,?,?,now())",[$_POST['product_id'],$_SESSION['id'],$db->verifyAndReturn($_POST['comment'])]))
                   $_SESSION['commented']=true;
            }
          ?>
        <form method=post>
          <?php if(isset($_SESSION['commented'])){ ?>
            <div class="alert alert-success text-center">Votre commentaire à été ajouter</div>
          <?php unset($_SESSION['commented']); } ?>
          <div class="form-group">
            <label>Ecrivez votre commentaire</label>
            <textarea type="text" name="comment" class="form-control border boder-primary"></textarea>
            <input type="hidden" name="product_id" value=<?=$_GET['p'];?>>
          </div>
          <input type=submit name="addComment" value=commenter class="btn btn-primary btn-block">
        </form>
		</div>
		<div class="col-md-8 col-sm-12">
				<h2><?=$arr['title']?></h2>
        <ul class="nav nav-pills">
            <li><a data-toggle="pill" href="#home" class="active">Détails</a></li>
            <li><a data-toggle="pill" href="#menu1" class="">Livraison</a></li>
        </ul>
  
        <div class="tab-content">
          <div id="home" class="tab-pane fade in active show">
            <h3><?=$arr['title']." (".$arr['prix']." DH)"?></h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum, reprehenderit hic! Quaerat dicta commodi eveniet, esse neque perspiciatis exercitationem hic corporis molestiae nulla id repellendus ipsum vero voluptas in. Autem reiciendis aperiam voluptatibus voluptate. Quae molestias itaque neque doloremque voluptatem.</p>
          </div>
          <div id="menu1" class="tab-pane fade">
            <h3>Livraison</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vel mollitia ducimus laborum, deleniti voluptas unde sed accusamus quasi ea alias ab totam et consectetur deserunt quo pariatur eum cupiditate quis quisquam delectus nihil. Exercitationem cumque eveniet praesentium architecto tenetur voluptatibus pariatur molestias explicabo voluptate debitis. Dicta aspernatur pariatur voluptatibus animi?</p>
          </div>
        </div>
				<hr class="bg-danger">
        <?php
          $comments=$db->returnData("select * from commentaires where product_id=".$_GET['p']." order by posted_at desc limit 10",'many');
          if(empty($comments)){
        ?>
        <div class="text-center pb-2 rounded font-weight-bold border border-top-0 border-success">Pas de commentaire pour ce produit actuellement</div>
        <?php }else{ ?>
        <div>
          <div class="font-weight-bold pb-3">Les 10 derniers commentaires:</div>
          <?php foreach($comments as $com){ ?>
            <div class="border-top border-primary pb-4">
              <span class="h6"><?=$com['content'];?></span>
              <span class="small text-muted justify-content-end"><?=$com['posted_at'];?></span>
            </div>
          <?php }} ?>
        </div>
		</div>
	</div>
</div>
<?php require_once('inc/footer.php') ?>