<?php $title = "Platformers - Accueil";


?>
<?php ob_start(); ?>
<div id="homeDiv" >

	<h1 class="bloodnGuts center">Platformers</h1>
	<br>	


	<video id="video" controls>
	  <source src="public/video/trailer.mp4" type="video/mp4">
	</video>

<form  class="bloodnGuts center" action="index.php?action=play" method="post">
		
		<button id="play" class="btn btn-primary" type="submit" >Jouer !</button>
	</form>

</div>
	
<?php $content = ob_get_clean(); ?>


<?php require('view/template/template.php'); ?>
