<!-- web -->
<nav id="nav" class=" navbar navbar-light navbar-expand-sm bg-dark navbar-dark justify-content-center ">


  <ul class="navbar-nav mx-auto text-center">
    <li class="nav-item">
      <?php   if ( isset($_SESSION['account'])){ ?>
      
      <a class="nav-link" href="./index.php?action=create">Créer</a>
      
      <?php }else{ ?>
      <a class="nav-link" href="./index.php?action=create" title="You need to be log !">Créer</a>
      
      <?php } ?>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="./index.php"><i id="home" class="fas fa-home"></i></a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="./index.php?action=play">Jouer</a>
    </li>
    
  </ul>
  
  


<ul id="log" class="nav navbar-nav ">
  <li class="nav-item">
    <?php   if ( isset($_SESSION['account'])){ ?>

        <a class="nav-link" href="./index.php?action=author&name=<?= $_SESSION['account'] ?>"><img id="avatar" alt="Avatar utilisateur"" class="rounded-circle" src="./public/img/avatar/<?= $_SESSION['avatar'] ?>"></a>

    <?php } ?>

  </li>
  <li class="nav-item">
    <?php   if ( isset($_SESSION['account'])){ ?>
    

    <a class="nav-link" id="aLog" href="./index.php?action=logout">Déconnexion</a>
    
    <?php }else{ ?>
    
    <a class="nav-link" id="aLog" href="./index.php?action=login">Connexion</a>
    
    <?php } ?>
  </li>
 </ul> 
</nav>

<!-- mobile -->
<nav id="mobile" class=" navbar navbar-light navbar-expand bg-dark navbar-dark justify-content-left ">


  <ul class="navbar-nav  text-center">
     <li class="nav-item">
      <a class="nav-link" href="./index.php"><i id="home" class="fas fa-home"></i></a>
    </li>
    <li class="nav-item">
      <?php   if ( isset($_SESSION['account'])){ ?>
      
      <a class="nav-link" href="./index.php?action=create">Créer</a>
      
      <?php }else{ ?>
      <a class="nav-link" href="./index.php?action=create" title="You need to be log !">Créer</a>
      
      <?php } ?>
    </li>
   
    
    <li class="nav-item">
      <a class="nav-link" href="./index.php?action=play">Jouer</a>
    </li>
    
  </ul>
  
  


<ul id="log" class="nav navbar-nav ">
  <li class="nav-item">
    <?php   if ( isset($_SESSION['account'])){ ?>

        <a class="nav-link" href="./index.php?action=author&name=<?= $_SESSION['account'] ?>"><img id="avatar" alt="Avatar utilisateur"" class="rounded-circle" src="./public/img/avatar/<?= $_SESSION['avatar'] ?>"></a>

    <?php } ?>

  </li>
  <li class="nav-item">
    <?php   if ( isset($_SESSION['account'])){ ?>
    

    <a class="nav-link" id="aLog" href="./index.php?action=logout"><i class="fas fa-power-off"></i></a>
    
    <?php }else{ ?>
    
    <a class="nav-link" id="aLog" href="./index.php?action=login"><i class="fas fa-power-off"></i></a>
    
    <?php } ?>
  </li>
 </ul> 
</nav>