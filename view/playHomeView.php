<?php $title = "Platformers - Jouer";


?>
<?php ob_start(); ?>

<?php foreach ($lvls as $lvl){ ?>


<div class="row justify-content-md-center margin-0">
	<div class="col-md-8">
		<div class="card flex-lg-row lg-4 box-shadow cardColor">
	        <div class="card-body d-flex flex-column align-items-start">
	            <a href="index.php?action=play&id=<?= $lvl->id ?>"><img class="thumbnail" alt="thumbnail lvl" src="./public/img/lvl/<?= $lvl->img ?>"></a>
	        </div>
	        <div class="card-body d-flex flex-column align-items-end">
	            <a href="index.php?action=author&name=<?= $lvl->author ?>">
	            	<img class="card-img-right flex-auto d-none d-lg-block avatar"  alt="avatar" src="./public/img/avatar/<?= $lvl->avatar ?>" >
	            </a>
	         	<br>
	            <p class="author">Créer par : <a href="index.php?action=author&name=<?= $lvl->author ?>">  <?= $lvl->author ?></a></p>	
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
		<a href="index.php?action=play&p=<?= ($p-1) ?>"> <- Précédents </a>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php } 

		if ($p<$maxPage){?>
		<a href="index.php?action=play&p=<?= ($p+1) ?>"> Suivant -> </a>
		<?php } ?>
	</p>
</div>
<?php $content = ob_get_clean(); ?>


<?php require('view/template/template.php'); ?>
