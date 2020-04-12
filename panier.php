<?php
    $titre="Panier";
    include_once('inc/header.php');
    $db=new db;
    if(!isset($_SESSION['user'])){ // si c'est un client connecté
        if(isset($_COOKIE['token'])){
            $q="SELECT * FROM users where token='".$db->verifyAndReturn($_COOKIE['token'])."'";
            $result=$db->returnData($q);
            if(empty($result)){
                header('Location: login');
                exit;
            }else{
                $_SESSION['user']=$result['username']; //on recupere le nom du client
                $_SESSION['id']=$result['id']; //on recupere l'ID du client
            }
        }else{ // si n'est pas un client
            header('Location: login?visiteur'); //redirection vers la page de login
            exit;
        }
    }
    //ajout d'un produit au panier si le client a cliqué sur ajouter au panier
    if(isset($_POST['submit'])){
        try{
            $q="insert into panier values(NULL,?,?,?,?)";
            $data=explode(',',$_POST['data']);
            array_push($data, $_SESSION['id']);
            if($db->insertData($q, $data)){
                $Response="Produit ajouter au panier avec success";
                $alert_type="success";
            }else{
                $Response="Produit n'est pas ajouter";
                $alert_type="danger";
            }

        }catch(Exception $e){
            $Response=$e->getMessage();
            $alert_type="danger";
        }
    }
    include_once('inc/nav.php');
    
    //suppression d'un produit du panier
    if(isset($_POST['delete'])){
        $db->deleteData("delete from panier where id='".$db->verifyAndReturn($_POST['id'])."'");
    }
?>

<div class="container content">
    <?php if(isset($Response)){ ?>
        <div class="mt-2 alert alert-<?= $alert_type; ?>"><?= $Response; ?></div>
    <?php } ?>
<table class="table table-striped mt-3 mb-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col-sm-1">Id</th>
      <th scope="col">Titre</th>
      <th scope="col">Prix(DH)</th>
      <th scope="col-sm-3">Image</th>
      <th scope="col-sm-3">quantité</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
            if(!isset($_SESSION['id'])){
                 $q="select id from users where username='".$_SESSION['user']."'";
                 $_SESSION['id']=$db->returnData($q,'one')['id'];
            }
            $q="SELECT *,count(*) as quantite FROM panier where user_id='".$_SESSION['id']."' group by title";// on recupere tous les produits ajouté par ce client à son panier
            $arr=$db->returnData($q,'many');
        if(!$arr){ ?> <!-- si le panier est vide -->
            <tr>
                <td colspan=6>
                    <div class="lead text-center">Pas de Produit Actuelement
                        <a class="btn btn-dark" href="index">Ajouter Des Produits</a>
                    </div>
                </td>
            </tr>
        <?php }else{ //sinon on afficher l'ensemble des produits ajoutés ar le client
        foreach($arr as $element){
    ?>
    <tr>
      <th scope="row"><?php echo $element['id']; ?></th>
      <td><?php echo $element['title']; ?></td>
      <td><?php echo $element['prix']; ?></td>
      <td>
          <img src="<?php echo $element['image']; ?>" class="img-thumbnail">
      </td>
      <td><?php echo $element['quantite']; ?></td>
      <td>
          <form method=post action=panier>
    		<div class="btn-group">
    			<a href="checkout"><button type="button" class="pr-3 btn btn-success"><i class="fas fa-shopping-bag"></i></button></a>
    			<input type=hidden name=id value=<?php echo $element['id']; ?>>
    			<button type="submit" name='delete' class="pl-3 btn btn-danger"><i class="fas fa-trash"></i></button>
    		</div>
          </form>
      </td>
    </tr>
    <?php }} ?>
  </tbody>
</table>
</div>

<?php include_once('inc/footer.php'); ?>