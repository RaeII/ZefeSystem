<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="titulo">Deletar</div>

<?php

require_once "conexao.php";
$registros = [];
$conexao = novaConexao();

if($_GET['excluir']){
    $excluiSql = "DELETE FROM cadastro WHERE id = ?";
    $stmt = $conexao->prepare($excluiSql);//prepare cuida de valores invalidos, cuida da injection, deixando mais seguro
    $stmt->bind_param("i",$_GET['excluir']);
    $stmt->execute();

}

$sql = "SELECT id, nome, cpf, nascimento, email FROM cadastro";

$resultado = $conexao->query($sql);


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
        <th>E-mail</th>
        <th>Ações</th>

    </thead>
    <tbody>
        <?php foreach ($registros as $registro) : ?>
            <tr>
                <td><?= $registro['id'] ?></td>
                <td><?= $registro['nome'] ?></td>
                <td><?= $registro['cpf'] ?></td>
                <td><?= $registro['email'] ?></td>  
                <td><a href="http://localhost/ZefeSystem/acess.php?dir=db&file=deletar&excluir=<?=$registro['id']?>" class="btn btn-danger">Excluir</a></td>  
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<style>
  table > *{
      font-size: 1.2rem;
  }
</style>