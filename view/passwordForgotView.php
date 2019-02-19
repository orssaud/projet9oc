<?php $title = "Platformers - Mot de passe oublier";


?>
<?php ob_start(); ?>
<br>
<div class="row justify-content-md-center margin-0">
	<h2>Changer mon mot de passe</h2>
</div>
<br>



	<div class="row justify-content-md-center margin-0">
	    <div class="col-md-3">
	        <form class="form-group" action="index.php?action=sendPassword" method="post">
	        	<div class="form-group">
	                <input type="email" class="form-control center-text" id="email" name="email" placeholder="Email" required  value="<?php if(isset($email)){echo($email);}?>" /> 
	            </div>
	            <br>
	            <div class="row justify-content-md-center margin-0">
	            	<button type="submit" class="btn btn-primary">Envoyer</button>
	            </div>
	        </form>

	    </div>
	</div>

<?php $content = ob_get_clean(); ?>


<?php require('view/template/template.php'); ?>
