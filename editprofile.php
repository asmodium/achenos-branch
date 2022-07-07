<?php require_once 'vars.php'; require_once 'config/config.php'; require_once 'lib/handling.php'; require_once 'lib/Session.php';   ?>
<?php 
  Session::checkSession();
  $user = new Handling();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
    <script src="script.js"></script>
    <title>Configurações do perfil</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
<div class="row position-static" name="navbar">
    <?php include_once(DIR."/include/navbar.php"); ?>
    </div>

<div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center"><img src="<?php echo Session::get('profilepic');?>" alt="..." width="" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        <div class="media-body">
          <h4 class="m-1"><?php echo Session::get('name');?></h4>
          <p class="font-weight-light text-muted mb-0">Web developer</p>
        </div>
      </div>
    </div>
  
    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Configurações de perfil</p>
  
    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="?pc=name" class="nav-link text-dark font-italic bg-light">
                  <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                  Alterar Nome
              </a>
      </li>
      <li class="nav-item">
        <a href="?pc=email" class="nav-link text-dark font-italic">
                  <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                  Alterar Email
              </a>
      </li>
      <li class="nav-item">
        <a href="?pc=senha" class="nav-link text-dark font-italic">
                  <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                  Alterar Senha
              </a>
      </li>
    </ul>
</div>
  <div class="page-content p-5" id="content">

  <!-- Demo content -->
  <h2 class="display-4 text-white">Lorem ipsum dolor sit amet</h2>
  <div class="separator"></div>
  <div class="container"><?php
            if(isset($_GET['pc'])){
                $confp = $_GET['pc'];
                switch($confp){
                    case "nome":
                        include_once(DIR.'/iframes/editprofile/editname.php');
                        break;
                    case "senha":
                        include_once(DIR.'/iframes/editprofile/editpassword.php');
                        break;
                    case "email":
                        include_once(DIR.'/iframes/editprofile/editemail.php');
                        break;
                    case "pic":
                        include_once(DIR.'/iframes/editprofile/editpic.php');
                        break;
                    default:
                        include_once(DIR.'/iframes/editprofile.php');
                        break;
                }
            }
            else{
                include_once(DIR.'/iframes/editprofile.php');
            }            
        ?></div>

</div>

</div>
</body>