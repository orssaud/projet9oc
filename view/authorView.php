<?php $title = "Platformers - " .  $_GET['name'] ;
?>
<?php ob_start(); ?>

<div class="row justify-content-center margin-0">
	<?php   if (isset($_SESSION['account']) && ($_SESSION['account']) == $_GET['name']){ ?>
	<form class="form-group" action="index.php?action=sendAvatar" method="post" enctype="multipart/form-data">
		<div id="avatarGroup">
			
			<div id="fileDiv" >
				<?php } ?>
				<img id="imgAvatar" alt="Avatar utilisateur"  class='accountAvatar' src="./public/img/avatar/<?= $authorAvatar ?>">
				
				<?php   if (isset($_SESSION['account']) && ($_SESSION['account']) == $_GET['name']){ ?>
				<button id="downloadButton" ><i class="fas fa-download"></i></button>
				<label for="file"></label>
				<input type="file" id="file" name="file" />
			</div>
			
		</div>
		
		<br>
		<div id="menuAvatar" >
			<button type="submit" id="cancel" class="btn btn-danger">Annuler</button>
			<button type="submit" id="submitAvatar" class="btn btn-primary">valider</button>
			
		</div>
		<div id="menuAvatarError" class="alert alert-danger" role="alert">
			<p id="errorAvatar"></p>
		</div>
	</form>
	<script type="text/javascript" src="./public/js/web/avatar.js"></script>
	<?php } ?>
</div>

<div class="row justify-content-center margin-0">
	<p><?= $_GET['name'] ?></p>
</div>


<?php
foreach ($lvls as $lvl){
?>


<div class="row justify-content-md-center margin-0">
	<div class="col-md-8">
		<div class="card flex-md-row mb-4 box-shadow cardColor">
			<div class="card-body d-flex flex-column align-items-start">
				<a href="index.php?action=play&id=<?= $lvl->id ?>"><img class="thumbnail" alt="Miniature d'un niveau" src="./public/img/lvl/<?= $lvl->img ?>"></a>
			</div>
			
		</div>
	</div>
</div>
<br>
<?php
}
?>
<div class="row justify-content-md-center margin-0">
	<p>
		<?php
		if ($p>1){
		?>
		<a href="index.php?action=play&name=<?= $lvls[0]->author ?>&p=<?= ($p-1) ?>"> <- Précédents </a>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php }
		if ($p<$maxPage){?>
		<a href="index.php?action=play&name=<?= $lvls[0]->author ?>&p=<?= ($p+1) ?>"> Suivant -> </a>
		<?php } ?>
	</p>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template/template.php'); ?>