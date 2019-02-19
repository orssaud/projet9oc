<?php $title = "Platformers - Connexion";


?>
<?php ob_start(); ?>

<div>
	

  <br>  <br>
	<div class="row justify-content-md-center margin-0 ">
	    <div class="col-md-3">
	        <form class="form-group" action="index.php?action=login" method="post">
	            <div class="form-group">
	                <label for="account"></label>
	                <input type="text" class="form-control center-text" id="account" name="account" placeholder="Compte" required value="<?php if(isset($account)){echo($account);}?>"  />
	            </div>
	            <div class="form-group">
	                <label for="password"></label>
	                <input type="password" class="form-control center-text" id="password" name="password" placeholder="Mot de passe" required value="<?php if(isset($password)){echo($password);}?>"  />
	            </div>
	            <br>

	            
	            <div class="row justify-content-md-center margin-0" >
					<button type="submit" class="btn btn-primary">Connexion</button>
				</div>
	        </form>

	    </div>
	</div>

<br>  <br>
	
	<div class="row justify-content-md-center margin-0" >
		<p>Pas de compte ? <a href="./index.php?action=signup">Créez-en un !</a> </p>
	
	</div>
	<div class="row justify-content-md-center margin-0" >
		<p> <a href="./index.php?action=password"> Mot de passe oublier ?</a></p>
	</div>
</div>


<?php $content = ob_get_clean(); ?>


<?php require('view/template/template.php'); ?>
