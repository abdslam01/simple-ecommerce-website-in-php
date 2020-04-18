<?php
$titre='Dashboard';
include_once('inc/header.php');
$db=new db;
include_once('inc/nav.php');
    $result=$db->returnData("SELECT * FROM users where token='".$db->verifyAndReturn($_COOKIE['token'])."'",'one');
    if(!isset($_SESSION['user'])){
         if(isset($_COOKIE['token'])){
            if(empty($result)){
                 session_unset();
                header('location: index');exit;
            }else
                $_SESSION['user']=$result['username'];
        }else{header('location: index');exit;} 
    }else{
    if($result["role"]!="admin"){
		header('Location: index');
 		exit;
    }
}
if(isset($_POST['ajouter'])){
    $errors=[];
    $imgName='img/'.time().'.'.explode('/',$_FILES["image"]["type"])[1];
    if(move_uploaded_file($_FILES["image"]["tmp_name"],$imgName) != 1)
        $errors['image']=true;
    if(empty($_POST['title']) || empty($_POST['price']) || empty($_POST['details']))
        $errors['empty_input']=true;
    if(empty($errors)){
        if($db->insertData("insert into produits values(NULL,?,?,?,?)",[$_POST['title'],$_POST['price'],$imgName,$_POST['details']])){
            $success=true;
        }
    }
}
?>
<div class="container content mt-3">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <?php if(isset($success)){ ?>
                <div class="alert alert-success">le produit à été ajouter avec succès</div>
            <?php }
            if(isset($errors['empty_input'])){ ?>
                <div class="alert alert-danger">tous les champs sont obligatoire !</div>
            <?php } ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
					<label for="">intitulé du produit: </label>
					<input type="text" name="title" value="<?=isset($_POST['title'])?$_POST['title']:''; ?>" class="form-control border-bottom-sucess" autocomplete="off">
				</div>
				<div class="form-group">
					<label for="">prix: </label>
					<input type="number" name="price" value="<?=isset($_POST['price'])?$_POST['price']:''; ?>" class="form-control border-bottom-sucess" autocomplete="off">
				</div>
				<div class="form-group">
					<label for="">détails du produit: </label>
					<textarea type="text"  name="details" value="<?=isset($_POST['details'])?$_POST['details']:''; ?>" class="form-control border-bottom-sucess" autocomplete="off"></textarea>
				</div>
				<div class="form-group">
    				<div class="custom-file">
                        <input type="file" name=image required>
                    </div>
                    <?php if(isset($errors['image'])){ ?>
                        <div class="alert alert-danger">erreur de telechargement de l'image, svp ressayer !</div>
                    <?php } ?>
                </div>
				<input type="submit" name="ajouter" value="ajouter" class="btn btn-secondary btn-block mb-3">
            </form>
        </div>
    </div>
</div>
<?php include('inc/footer.php');?>