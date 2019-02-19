<?php $title = "Platformers - Erreur";


?>
<?php ob_start(); ?>
<div class="row justify-content-md-center margin-0">
	<h3>
	
		<p>
			<?php echo 'Erreur : ' . $e->getMessage(); ?>
			<br><br>
			<a href="./index.php">Retour à la page d'accueil</a>
		</p>
	
	</h3>
</div>	
	
	

<?php $content = ob_get_clean(); ?>
<?php require('view/template/template.php'); ?>