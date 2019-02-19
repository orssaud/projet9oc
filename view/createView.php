<?php $title = "Platformers - Créer";


?>
<?php ob_start(); ?>

<div id="grid">
<div id="tuto"></div>


	<div id="player"></div>

	<div id="obj4" class="block border-grid item"></div>
	<div id="obj5" class="block border-grid item"></div>
	<div id="obj6" class="block border-grid item"></div>
	<div id="obj7" class="block border-grid item"></div>

	

</div>


<div id="saveScreen" class="shadowBg">


	<div class="alert alert-success alertBox">
		<br><br>
		<div class="row justify-content-md-center margin-0">
			<h3>Vicoire!</h3>
		</div>
		<div class="row justify-content-md-center margin-0">
			<i>Vous devez terminer le niveau une fois sans le modifier pour pouvoir le sauvegarder.</i>
		</div>
		<br>
		<div class="row justify-content-md-center margin-0">
			<i class="red fas fa-exclamation-triangle"> La sauvegarde est définitive. Il est impossible de modifier le niveau ultérieurement.</i>
		</div>
		<br>
	
		
		<div class="container">
		  <div class="row">
		    <div class="col-sm center">
		      				<button class="btn btn-success" id="replay">Rejouer</button>

		    </div>
		    <div class="col-sm center">
		<form action="./index.php?action=save" method="post">
					
							<div>
								<input id="lvl" name="lvl" type="hidden" value="">
							</div>
							<div>
								<button class="btn btn-success" id="save" type="submit">Sauvegarder !</button>
							</div>
						</form>    </div>
		    <div class="col-sm center">
		      <form action="index.php?action=play" method="post">
							<button class="btn btn-outline-success" type="submit">Retour Menu</button>
						</form>
		    </div>
		  </div>
		</div>
	</div>
	
</div>

<button id="info" class="info"><i class="fas fa-info-circle"></i></button>
<div id="infoPopup"><img id="imgInfo" src="./public/img/tuto/create.png"></div>
<script type="text/javascript" src="./public/js/web/info.js"></script>

<script type="text/javascript" src="./public/js/app/create/save.js"></script>
<script type="text/javascript" src="./public/js/app/play/size.js"></script>
<script type="text/javascript" src="./public/js/app/play/2dEngine.js"></script>
<script type="text/javascript" src="./public/js/app/create/grid.js"></script>
<script type="text/javascript" src="./public/js/app/create/main.js"></script>

<?php $content = ob_get_clean(); ?>


<?php require('view/template/template.php'); ?>
