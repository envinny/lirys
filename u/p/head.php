<!-- lentête -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#06AE31;">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"><img src="img/logo.png" alt="" style="width:40px;"></a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      
      <a class="navbar-brand" href="#"><?php echo utf8_encode(ucwords($dataUs->nom." ". $dataUs->prenom));?></a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"><i class="home icon"></i> Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active <?php if (isset($_GET['f']) AND $_GET['f'] == "pro") {
            echo "ui white button";
          } ?>" aria-current="page" href="?f=pro"><i class="user icon"></i> Profil</a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link active <?php if (isset($_GET['f']) AND $_GET['f'] == "tdb") {
            echo "ui white button";
          } ?>" aria-current="page" href="?f=tdb"><i class="table icon" style="color:#fff;"></i> Tableau de bord</a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link active <?php if (isset($_GET['f']) AND $_GET['f'] == "msg") {
            echo "ui white button";
          } ?>" aria-current="page" href="?f=msg"><i class="comments icon" style="color:#fff;"></i> Chat général <?php if ($dataUs-> msg == 0) { ?><span class="badge bg-danger">...</span><?php } ?></a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link active <?php if (isset($_GET['f']) AND $_GET['f'] == "ntf") {
            echo "ui white button";
          } ?>" aria-current="page" href="?f=ntf"><i class="bell icon" style="color:#fff;"></i> Notification <?php if ($ntf_att !== 0) { ?><span class="badge bg-danger"><?php echo $ntf_att; ?></span><?php } ?> </a>
          
        </li>
      </ul>
      <form class="d-flex">
            <a class="me-3" href="../" style="color:#fff;"><i class="home icon"></i></a>
            <a class="" href="../deconnexion" style="color:#fff;"><i class="sign out alternate icon"></i></a>
      </form>
    </div>
  </div>
</nav>