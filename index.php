<?php require_once("handling.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Achenos - O seu profissional</title>
</head>
<body>
    <div name="navbar">
    <?php include_once(DIR."/include/unsetsessionnavbar.php"); ?>
    </div>
    <div name="container">
        
    <?php
            if(isset($_GET['p'])){
                $pagina = $_GET['p'];
                switch($pagina){
                    case "prestadores":
                        include(DIR.'/iframes/prestadores.php');
                        break;
                    case "cadastro":
                        include(DIR.'/iframes/cadastro.php');
                        break;
                    case "login":
                        include(DIR.'/iframes/login.php');
                        break;
                    default:
                        include(DIR.'/iframes/home.php');
                        break;
                }
            }
            else{
                include(DIR.'/index.php');
            }            
        ?>
    </div>
</body>
</html>