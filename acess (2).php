<?php
  session_start();
  if($_COOKIE['usuario']){
    $_SESSION['usuario'] = $_COOKIE['usuario'];
 }
  if(!$_SESSION['usuario']){
     header('location:login.php');
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/acess.css">
    <title>Exercício</title>
</head>
<body class="exercicio">
    <header class="cabecalho">
        <h1>ZefeSystem</h1>
        
    </header>
    <nav class="navegacao">
    <a  href="index.php#">Home</a>
    </nav>
    <main class="principal">
        <div class="conteudo">
            <?php
                include(__DIR__ . "/{$_GET['dir']}/{$_GET['file']}.php");
            ?>
        </div>
    </main>
    <footer class="rodape">
    ZefeSystem© <?= date('Y'); ?>
    </footer>
</body>
</html>