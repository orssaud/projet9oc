<?php $title = "Platformers - Jouer";


?>
<?php ob_start(); ?>



<div id="grid">



	<div id="player"></div>
	<?= $lvl->data ?>

	<div id="obj4" class="block border-grid item"></div>
	<div id="obj5" class="block border-grid item"></div>
	<div id="obj6" class="block border-grid item"></div>
	<div id="obj7" class="block border-grid item"></div>

	

</div>


<div id="winScreen" class="shadowBg">

	<div class="alert alert-success alertBox">
		<br><br>
		<div class="row justify-content-md-center margin-0">
			<h3>Vicoire!</h3>
		</div>
		<br><br>
		<div class="row justify-content-md-center margin-0">
			<button class="btn btn-success" id="replay">Rejouer</button>
		</div>
		<br>
		<div class="row justify-content-md-center margin-0">
			<form action="index.php?action=play" method="post">
				<button class="btn btn-outline-success" type="submit">Retour Menu</button>
			</form>
		</div>
	</div>
	
</div>

<button id="info" class="info"><i class="fas fa-info-circle"></i></button>
<div id="infoPopup"><img id="imgInfo" src="./public/img/tuto/move.png"></div>
<script type="text/javascript" src="./public/js/web/info.js"></script>

<script type="text/javascript" src="./public/js/app/play/size.js"></script>
<script type="text/javascript" src="./public/js/app/play/2dEngine.js"></script>
<script type="text/javascript" src="./public/js/app/play/main.js"></script>

<?php $content = ob_get_clean(); ?>


<?php require('view/template/template.php'); ?>
