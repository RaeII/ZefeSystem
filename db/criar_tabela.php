<div class="titulo">Criando tabela</div>

<?php

require_once 'conexao.php';

$sql = "CREATE TABLE IF NOT EXISTS cadastro(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
cpf VARCHAR(11) NOT NULL,
nascimento DATE,
email VARCHAR(100),
dogs INT,
idade INT
)";

$conexao = novaConexao();
$resultado = $conexao->query($sql);

if($resultado) {
    echo 'sucesso ;)';

}else {'ERRO '. $conexao->error;}

$conexao->close();



?>