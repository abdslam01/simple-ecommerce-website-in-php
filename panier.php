<?php
session_start(); 
    $titre="Panier";
    include_once('inc/header.php');
    if(!isset($_SESSION['user'])){
        if(isset($_COOKIE['token'])){
            $q="SELECT * FROM users where token='".verifyAndReturn($_COOKIE['token'])."'";
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($q);
            $stmt->execute();
            $result=$stmt->get_result()->fetch_assoc();
            if(empty($result)){
                header('Location: login');
                exit;
            }else{
                $_SESSION['user']=$result['username'];
                $_SESSION['id']=$result['id'];
            }
        }else{
            $_SESSION['guest']="guest";
            header('Location: login');
            exit;
        }
    }
    //Add a product
    if(isset($_POST['submit'])){
        try{
            $a=explode(',',$_POST['data']);
            $q="insert into panier values(NULL,?,?,?,?)";
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($q);
             $stmt->bind_param("ssss",$a[0],$a[1],$a[2],$_SESSION['id']);
            if($stmt->execute()){
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
    //end Add product
    include_once('inc/nav.php');
    
    //delete a product
    if(isset($_POST['delete'])){
        $stmt = $mysqli->query("delete from panier where id='".$_POST['id']."'");
    }
?>

<div class="container">
    <?php if(isset($Response)){ ?>
        <div class="mt-2 alert alert-<?php echo $alert_type; ?>"><?php echo $Response; ?></div>
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
                 $stmt = $mysqli->stmt_init()->prepare("select id from users where username='".$_SESSION['user']."'");
                 $stmt->execute();
                 $arr=$stmt->get_result()->fetch_assoc();
                 $_SESSION['id']=$arr['id'];
            }
            $q="SELECT *,count(*) as quantite FROM panier where user_id='".$_SESSION['id']."' group by title";
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($q);
            $stmt->execute();
            $arr=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(!$arr){ ?>
            <tr>
                <td colspan=5>
                    <div class="lead text-center">Pas de Produit Actuelement</div>
                </td>
            </tr>
        <?php }else{
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
    			<a href="checkout"><button type="button" class="btn btn-sm btn-success">Acheter</button></a>
    			<input type=hidden name=id value=<?php echo $element['id']; ?>>
    			<button type="submit" name='delete' class="btn btn-sm btn-danger">Supprimer</button>
    		</div>
          </form>
      </td>
    </tr>
    <?php }} ?>
  </tbody>
</table>
</div>
<div class="clearfix pt-5"></div>

<?php include_once('inc/footer.php'); ?>