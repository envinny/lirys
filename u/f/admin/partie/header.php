<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#06AE31;">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#"><?php echo ucwords($admin_data->nom." ". $admin_data->prenom)?></a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"><i class="home icon"></i> Accueil</a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?tdb"><i class="table icon" style="color:#fff;"></i> Tableau de bord</a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?tdb"><i class="bell icon" style="color:#fff;"></i> Notification</a>
          
        </li>
      </ul>
      <form class="d-flex">
            <a class="me-3" href="?f=pro" style="color:#fff;"><i class="home icon"></i></a>
            <a class="" href="../deconnexion" style="color:#fff;"><i class="sign out alternate icon"></i></a>
      </form>
    </div>
  </div>
</nav>