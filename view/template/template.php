<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Platformers" />
    <meta name="twitter:description" content="Un site de création de jeu de plates-forme" />
    <meta name="twitter:image" content="http://www.orssaud.ovh/projet9/public/img/metaImage.jpg" />
    <meta name="twitter:url" content="http://www.orssaud.ovh/projet9" />
    <meta name="description" content="Créer vos niveaux sur Platformers et partager les avec vos amis">
    <meta name="author" content="Jean Forteroche">
    <meta property="og:title" content="Platformers" />
    <meta property="og:type" content="site web" />
    <meta property="og:url" content="http://www.orssaud.ovh/projet9" />
    <meta property="og:image" content="http://www.orssaud.ovh/projet9/public/img/metaImage.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title><?= $title ?></title>
       

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


         <link href="./public/css/style.css" rel="stylesheet" type="text/css" /> 
         <link href="./public/css/web.css" rel="stylesheet" type="text/css" /> 

      <link rel="shortcut icon" type="image/x-icon" href="./public/img/favicon.ico">       

    </head>
        
    <body>

   
   	<!-- 		Nav menu 		-->
     <?php require('nav.php'); ?>
    <!-- 		////////		-->
    <br>
    <!--         alert          --> 
    <?php require('view/template/alert.php'); ?>
    <!--        ////////        -->



      <div class="container">
      <?= $content ?>
    </div>

    </body>
</html>