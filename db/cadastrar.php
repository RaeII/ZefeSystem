<div class="titulo">Cadastrar</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php

require_once('./cpf/cpf.php');
$dados= null;

if (count($_POST) > 0) {
    $erros = [];
    $dados=$_POST;

    //aqui um input simples se está presente ou não
    if (trim($dados['nome']) === "") { //filter seria algo que quero valido sobre o input
        $erros["nome"] = 'Nome obrigatorio!';
    }

    if ($dados['nascimento']) {
        $data = DateTime::createFromFormat('d/m/Y', $dados['nascimento']);
        if (!$data) {
            $erros["nascimento"] = 'Forneça a data no padrão dd/mm/aaaa';
        }
    }
    if (trim($dados['cpf']) === "") {
        $erros['cpf'] = 'CPF obrigatorio!';
    }else if(verificarCpf($dados['cpf'])){
         $dados['cpf']=verificarCpf($dados['cpf']);
    }else{$erros['cpf']='CPF invalido!';}

    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros["email"] ='Email invalido';
    }


    $dogconfig = [
        'options' => ['min_range' => 0, 'max_range' => 50]
    ];

    if (!filter_var($dados['dogs'], FILTER_VALIDATE_INT, $dogconfig) && $dados['dogs'] != 0) {
        $erros["dogs"] ='Quantidade invalida de doguinhos';
    }

    $idadeConfig = [
        'options' => ['min_range' => 0, 'max_range' => 99]
    ];

    if (!filter_var($dados['idade'], FILTER_VALIDATE_INT, $idadeConfig) && $dados['idade'] != 0) {
        $erros["idade"] ='Idade invalida';
    }

    if(count($erros) == 0 ){

        require_once 'conexao.php';
        $conexao = novaConexao();

        $sql = "INSERT INTO cadastro
        (nome, cpf, nascimento, email, dogs, idade)
        VALUES (?, ?, ?, ?, ?, ?)";
   

        $stmt = $conexao->prepare($sql);

        $params = [
            $dados['nome'],
            $dados['cpf'],
            $data ? $data->format('Y-m-d'):null,
            $dados['email'],
            $dados['dogs'],
            $dados['idade']
        ];

        $stmt->bind_param("ssssdd", ...$params);

        if($stmt->execute()){
            $dados = null;
        }else{echo $stmt->error;}
    }
}
?>





<form action="#" method="POST">

    <div class="form-row">
        <!--Classe bootstrap, compos na mesma linha, 12 colunas -->
        <div class="form-group col-md-7">
            <!--define tamnho grupo input-->
            <label for="nome">Nome</label>
            <input type="text" class='form-control <?= $erros['nome']? 'is-invalid':""?>' id="nome" name="nome" placeholder="Nome" value="<?= $dados['nome'] ?>">
            <div class="invalid-feedback">
            <?=$erros['nome']?>
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="cpf">CPF</label>
            <input type="text" class='form-control <?= $erros['cpf']?'is-invalid':""?>' id="cpf" name="cpf" placeholder="CPF" value="<?= $dados['cpf'] ?>">
            <div class="invalid-feedback">
            <?=$erros['cpf']?>
            </div>
        </div>
        <div class="form-group col-md-2 ">
            <label for="Nascimento">Nascimento</label>
            <input type="text" class='form-control <?= $erros['nascimento']?'is-invalid':""?>' id="nascimento" name="nascimento" placeholder="Data" value="<?= $dados['nascimento'] ?>">
            <div class="invalid-feedback">
            <?=$erros['nascimento']?>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6 ">
            <label for="email">E-mail</label>
            <input type="text" class='form-control <?= $erros['email']? 'is-invalid':""?>' id="email" name="email" placeholder="E-mail" value="<?= $dados['email'] ?>">
            <div class="invalid-feedback">
            <?=$erros['email']?>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6 ">
            <label for="dogs">Qtd de cachorros</label>
            <input type="number" class='form-control <?= $erros['dog']? 'is-invalid':""?>' id="dogs" name="dogs" placeholder="Doguinhos" value="<?= $dados['dogs'] ?>">
            <div class="invalid-feedback">
            <?=$erros['dogs']?>
            </div>
        </div>
        <div class="form-group col-md-2 ">
            <label for="idade">Idade</label>
            <input type="number" class='form-control <?= $erros['idade']? 'is-invalid':""?>' id="idade" name="idade" placeholder="Idade" value="<?= $dados['idade'] ?>">
            <div class="invalid-feedback">
            <?=$erros['idade']?>
            </div>
        </div>
    </div>
    <button class='btn btn-primary'>Enviar</button>
</form>
