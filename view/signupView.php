<?php $title = "Platformers - Nouveau compte";

?>
<?php ob_start(); ?>


<div class="container-fluid" id="ajaxError">

	<div class="row justify-content-sm-center">
		<div class="col col-sm-8">

			<div class="alert alert-danger center" role="alert">
				
					
				<div id="ajaxEmail">
					
					<p>Cet email est déjà utilisé pour un autre compte.</p>

				</div>
				<div id="ajaxAccount">
					
					<p>Ce compte existe déjà.</p>

				</div>

			</div>
				
		</div>
	</div>
</div>


<div>


	<div class="row justify-content-md-center margin-0">
	    <div class="col-md-3">
	        <form class="form-group" action="index.php?action=newAccount" method="post">
	        	<div class="form-group">
	                <label for="email"></label>
	                <input type="email" class="form-control center-text" id="email" name="email" placeholder="Email" required value="<?php if(isset($email)){echo($email);}?>" /> 
	            </div>
	            <div class="form-group">
	                <label for="account"></label>
	                <input type="text" class="form-control center-text" id="account" name="account" placeholder="Compte" required value="<?php if(isset($account)){echo($account);}?>" />
	            </div>
	            <div class="form-group">
	                <label for="password"></label>
	                <input type="password" class="form-control center-text" id="password" name="password" placeholder="Mot de passe" required value="<?php if(isset($password)){echo($password);}?>" />
	            </div>
	            <div class="form-group">
	                <label for="password_verify"></label>
	                <input type="password" class="form-control center-text" id="password_verify" name="password_verify" placeholder="Confirmer le mot de passe" required value="<?php if(isset($password_verify)){echo($password_verify);}?>"/>
	            </div>
	            <br>
	            <div class="row justify-content-md-center margin-0">
	            	<button type="submit" class="btn btn-primary">Créer</button>
	            </div>
	        </form>

	    </div>
	</div>
 <br>
<div class="row justify-content-md-center margin-0">
	<p>Déjà un compte ? <a href="./index.php?action=login">Se connecter !</a> </p>
</div>
</div>

<script type="text/javascript" src="./public/js/web/ajax.js"></script>


<?php $content = ob_get_clean(); ?>


<?php require('view/template/template.php'); ?>
