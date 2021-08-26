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
    <title>Curso PHP</title>
</head>
<body>
    <header class="cabecalho">
         <h1>ZefeSystem</h1>
    </header>
    <nav class="navegacao">
       <span class = 'usuario'>User: <?=$_SESSION['usuario']?></span>
       <a href="logout.php">sair</a> 
    </nav>
    <main class="principal">
        <div class="conteudo">
            <nav class="modulos">
           <?php include('menu.php')?>
            </nav>
        </div>  
    </main>
    <footer class="rodape">
        ZefeSystem© <?= date('Y'); ?>
    </footer>
</body>
</html>