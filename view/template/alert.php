<br>
<div class="container-fluid">

	<div class="row justify-content-sm-center">
		<div class="col col-sm-8">

		<?php 

		/*-----------
			ERROR
		------------*/


			if(!empty($errors)){ 

				?>
					<div class="alert alert-danger center" role="alert">
				<?php

				foreach ($errors as $error){

					
					?>

					
					<p><?= $error ?></p>
					

					<?php
				}
				$errors = array();

				?>
					</div>
				<?php
			} 


		/*-----------
			success
		------------*/
			if(!empty($successes)){ 

				?>
					<div class="alert alert-success center" role="alert">
				<?php

				foreach ($successes as $success){

					
					?>

					
					<p><?= $success ?></p>
					

					<?php
				}
				$successes = array();

				?>
					</div>
				<?php
			} 





		?>

		</div>
	</div>
</div>