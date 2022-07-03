<?php
	include_once DIR.'/lib/Session.php';
	Session::init();
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
		Session::destroy();
	}
	
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Achenos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?p=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?p=prestadores">Prestadores</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <!--
                botão desativado
                <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Link</a>
        </li>-->
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Busca" aria-label="Busca">
        <button class="btn btn-outline-success" type="submit">Busca</button>
      </form>
      
      <ul class="nav navbar-nav navbar-right">
			 <?php
			  if(empty(Session::get('id'))){ ?>
			 	<li class="nav-item"><a class="nav-link" href="?p=login">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="?p=cadastro">Cadastro</a></li>
			 	<?php }else{ ?>
			 		<li><a href="?p=perfil">Perfil</a></li>
			 		<li><a href="?action=logout">Logout</a></li>
			 	<?php }?>
			 </ul>
    </div>
  </div>
</nav>