<?php
session_start();
$_SESSION['erros'] = null;

$email = $_POST['email'];
$senha = $_POST['senha'];

if ($_POST['email']) {
    $usuarios = [
        [
            'nome' =>  'admin',
            'email' => 'admin@yopmail.com',
            'senha' => 'admin'
        ],
        [
            'nome' => 'israel',
            'email' => 'israel.zeferino@hotmail.com',
            'senha' => '123'
        ],
        [
            'nome' => 'vitoria',
            'email' => 'vitoriapm99@gmail.com',
            'senha' => 'vitoriadocore'
        ]
    ];
}
foreach ($usuarios as $usuario) {
    $emailValido = $usuario['email'] === $email;
    $senhaValida = $usuario['senha'] === $senha;

    if ($emailValido && $senhaValida) {
        $_SESSION['erros'] = null;
        $_SESSION['usuario'] = $usuario['nome'];
        $exp = time() + 60 * 60 * 24 * 30;
        setcookie('usuario', $usuario['nome'], $exp);
        header('location:index.php');
    }
}
if (!$_POST['email'] && $_POST['senha']) {
    $_SESSION['erros'] = ['Mano, sem email o bagulho num vai'];
}
if (!$_POST['senha'] && $_POST['email']) {
    $_SESSION['erros'] = ['Parça, a senha não se bota sozinho'];
} else if (isset($usuario['email']) && isset($usuario['email'])) {
    foreach ($usuarios as $usuario) {
        $emailValido = $usuario['email'] !== $email;
        $senhaValida = $usuario['senha'] !== $senha;

        if ($emailValido && $senhaValida) {
            $_SESSION['erros'] = ['Cara, digitasse merda, tenta de novo'];
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="recursos/css/estilo.css">
    <link rel="stylesheet" href="recursos/css/login.css">
    <title>Curso PHP</title>
    <script type="text/javascript" src="recursos/js/mostrar.js"></script>
</head>

<body class='login'>
    <header class="cabecalho">
        <h1>ZefeSystem</h1>
    </header>

    <main class="principal">
        <div class="conteudo">
            <h3>Identifique-se</h3>
            <?php if ($_SESSION['erros']) : ?>
                <div class="erros">
                    <?php
                    foreach ($_SESSION['erros'] as $erros) : ?>
                        <p><?= $erros ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <form action="#" method='post'>
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name='email' id='email'>
                </div>
                <div>
                    <label for="senha">Senha</label>
                    <input type="password" name='senha' id='senha'>
                </div>
                <?php $_SESSION['erros'] = null; ?>
                <button>Entrar</button>
            </form>
            <ul>
            <li>Email: admin@yopmail.com</li>
            <li>Senha: admin</li>
            </ul>                
        </div>


    </main>


    <footer class="rodape">
        ZefeSystem© <?= date('Y'); ?>
    </footer>
    

</body>

</html>