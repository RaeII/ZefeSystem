<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="titulo">Registros</div>

<?php

require_once "conexao.php";

$sql = "SELECT id, nome, cpf, nascimento, email FROM cadastro";

$conexao = novaConexao();
$resultado = $conexao->query($sql);

$registros = [];

if ($resultado->num_rows > 0) { //se o numeros de linhas for mais que 0
    while ($row = $resultado->fetch_assoc()) { //vai fazer while para cada linha, assossiado a cada chave, fazendo um array de cada linha.
        $registros[] = $row;
    }
} elseif ($conexao->error) {
    echo "Erro: " . $conexao->error;
}

$conexao->close();


?>

<table class='table table-hover table-striped table-bordered'>
    <thead>
        <th>id</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Data</th>
        <th>E-mail</th>
    </thead>
    <tbody>
        <?php foreach ($registros as $registro) : ?>
            <tr>
                <td><?= $registro['id'] ?></td>
                <td><?= $registro['nome'] ?></td>
                <td><?= $registro['cpf'] ?></td>
                <td>
                <?= date('d/m/Y', strtotime($registro['nascimento'])) ?>
                </td>
                <td><?= $registro['email'] ?></td>  
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<style>
  table * {
      font-size: 1.5rem;
  }

</style>