<?php

$servidor = "10.8.1.11";
$usuario = "root";
$senha_DBA = "!ctiifpicacor@";
$banco = "refeitorio";

// Conecta-se ao banco de dados MySQL
$mysqli = new mysqli($servidor, $usuario, $senha_DBA, $banco);

$conexao = mysqli_connect($servidor, $usuario, $senha_DBA, $banco);

// Caso algo tenha dado errado, exibe uma mensagem de erro
if (mysqli_connect_errno())
    trigger_error(mysqli_connect_error());

//Cadastra Ficha e diminui o limite de fichas
function cadastrarFicha($conexao, $aluno_id, $data_hoje, $refeicao) {
    //funcao para verificar se a ficha já foi reservada
    if (verificarQuantidadeFichas($conexao, $data_hoje, $refeicao)) {
        // solicita refeicao na tabela ficha
        $pendente = 1;
        $sqlGravarSolicitacao = "INSERT INTO
			  ficha(aluno_id, data_ficha, pendente, hora_reserva, refeicao)
			  VALUES('$aluno_id', '$data_hoje', '$pendente', NOW(), '$refeicao')";
        //incrementa +1 na tupla reservadas
        //incrementaFicha($conexao, $aluno_id, $data_hoje);
        //executa as duas querys
        $query = $conexao->query($sqlGravarSolicitacao);
        $conexao->commit();
        return $query;



        //commit transaction */
        //$conexao->commit();
    }
}

function verifica_cardapio_mesmo_dia($conexao, $data_form, $refeicao) {
    $sql_cardapio = "SELECT * FROM cardapio WHERE Data = '$data_form' AND refeicao = '$refeicao'";
    $query_cardapio = $conexao->query($sql_cardapio);
    $row = $query_cardapio->num_rows;
    if ($row > 0) {
        return true;
    } else {
        return false;
    }
}

// Fim da função
//Funcao incrementa ficha na tabela cardapio
function incrementaFicha($conexao, $aluno_id, $data_hoje, $refeicao) {
    $sql_cardapio = "SELECT * FROM cardapio WHERE Data = '$data_hoje' AND refeicao = '$refeicao'";
    $query_cardapio = $conexao->query($sql_cardapio);
    while ($linha = mysqli_fetch_assoc($query_cardapio)) {
        $qtd_limite = $linha['qtd_limite'];
        $reservadas = $linha['reservadas'];
        $id_cardapio = $linha['id'];
    }
    //incrementa +1 na tupla reservadas
    $reservadas = $reservadas + 1;
    //Query incrementa ficha na tupla reservadas
    $sqlGravarReserva_incrementa = "UPDATE cardapio SET
			reservadas = '$reservadas'
			WHERE id = '$id_cardapio' AND refeicao = '$refeicao'";
    //executa as duas querys
    $query = $conexao->query($sqlGravarReserva_incrementa);
    //commit transaction */
    $conexao->commit();
}

function cancelarficha($conexao, $id, $data_hoje, $refeicao) {
    $sql_ficha = "SELECT * FROM ficha WHERE aluno_id = '$id' AND data_ficha = '$data_hoje' AND pendente = '1' AND refeicao = '$refeicao'";
    $verificador = 0;
    $query_ficha = mysqli_query($conexao, $sql_ficha);
    while ($linha = mysqli_fetch_assoc($query_ficha)) {
        $aluno_id = $linha['aluno_id'];
        $data_ficha = $linha['aluno_id'];
    }
    //Deletando a ficha da tabela ficha
    $query_ficha_deletar = "DELETE FROM ficha WHERE aluno_id = $id AND data_ficha = '$data_hoje'  AND pendente = '1' AND refeicao = '$refeicao'";
    $deletar_ficha = mysqli_query($conexao, $query_ficha_deletar);
    //decrementa ficha na tupla
    //decrementaFicha($conexao, $aluno_id, $data_hoje);
}

//Funcao decrementa ficha na tabela cardapio
function decrementaFicha($conexao, $aluno_id, $data_hoje, $refeicao) {
    $sql_cardapio = "SELECT * FROM cardapio WHERE Data = '$data_hoje' AND refeicao = '$refeicao'";
    $query_cardapio = $conexao->query($sql_cardapio);
    while ($linha = mysqli_fetch_assoc($query_cardapio)) {
        $qtd_limite = $linha['qtd_limite'];
        $reservadas = $linha['reservadas'];
        $id_cardapio = $linha['id'];
    }
    //incrementa -1 na tupla reservadas
    $reservadas = $reservadas - 1;
    //Query decrementa ficha na tupla reservadas
    $sqlGravarReserva_decrementa = "UPDATE cardapio SET
			reservadas = '$reservadas'
			WHERE id = '$id_cardapio' AND Data = '$data_hoje' AND refeicao = '$refeicao'";
    //executa as duas querys
    $query = $conexao->query($sqlGravarReserva_decrementa);
    //commit transaction */
    $conexao->commit();
}

// Verifica se o aluno já fez reserva para o dia...
function verificarReserva($conexao, $id, $data_hoje, $refeicao) {
    $sql_ficha = "SELECT * FROM ficha WHERE aluno_id = $id AND data_ficha = '$data_hoje' AND pendente = '1' AND refeicao = '$refeicao'";
    $verificador = false;
    $query_ficha = mysqli_query($conexao, $sql_ficha);
    while ($linha = mysqli_fetch_assoc($query_ficha)) {
        //$aluno_id = $linha['aluno_id'];
        $verificador = true;
    }
    return $verificador;
}

//Verificando a quantidade de fichas disponíveis no dia
function verificarQuantidadeFichas($conexao, $data_hoje, $refeicao) {

    $query_reservadas = "SELECT count(1) as c FROM ficha WHERE data_ficha = '$data_hoje' AND refeicao = '$refeicao'";
    $reservadas = mysqli_query($conexao, $query_reservadas);
    $jivago = mysqli_fetch_assoc($reservadas);
    $reservadas = $jivago['c'];

    $sql_cardapio = "SELECT * FROM cardapio WHERE Data = '$data_hoje' AND refeicao = '$refeicao'";
    $query_cardapio = mysqli_query($conexao, $sql_cardapio);
    $row = $query_cardapio->num_rows;
    if ($row > 0) {
        while ($linha = mysqli_fetch_assoc($query_cardapio)) {
            $qtd_limite = $linha['qtd_limite'];
            //$reservadas = $linha['reservadas'];
            $cardapio = $linha['Descricao'];
        }
        if ($reservadas >= $qtd_limite) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function mostrarCardapio($conexao, $data_hoje, $refeicao) {
    $sql_cardapio = "SELECT * FROM cardapio WHERE Data = '$data_hoje' AND refeicao = '$refeicao'";
    $query_reservadas = "SELECT count(1) as c FROM ficha WHERE data_ficha = '$data_hoje' AND refeicao = '$refeicao'";
    $reservadas = mysqli_query($conexao, $query_reservadas);
    $jivago = mysqli_fetch_assoc($reservadas);
    $reservadas = $jivago['c'];

    $query_cardapio = mysqli_query($conexao, $sql_cardapio);
    $row = $query_cardapio->num_rows;
    if ($row > 0) {
        while ($linha = mysqli_fetch_assoc($query_cardapio)) {
            $qtd_limite = $linha['qtd_limite'];
            //$reservadas = $linha['reservadas'];
            $cardapio = $linha['Descricao'];
        }
    }

    $verificarQuantidadeFichas = verificarQuantidadeFichas($conexao, $data_hoje, $refeicao);
    if ($row > 0) {
        if (!$verificarQuantidadeFichas) {
            echo "<p class='red lighten-3 centralizado'>RESERVA DE REFEIÇÕES ESGOTADAS!</p>";
        }
        echo "<p class='esquerda grey lighten-4'>Limite de Reservas:  $qtd_limite<br>";
        echo "Quantidade de reservas feitas: $reservadas</p>";
        echo " <div class='card-panel yellow lighten-5 z-depth-1'>";
        echo "Cardápio de hoje:<hr><h5>$cardapio</h5>";
        echo " </div>";
    } else {
        echo "<p class='yellow centralizado'>NÃO HÁ CARDÁPIO CADASTRADO PARA HOJE</p>";
    }
}

function verificarQtdPendencias($conexao, $aluno_id) {
    $sql_ficha = "SELECT * FROM ficha WHERE aluno_id = '$aluno_id' AND pendente = '1' ";
    $verificador = 0;
    $query_ficha = mysqli_query($conexao, $sql_ficha);
    while ($linha = mysqli_fetch_assoc($query_ficha)) {
        $verificador = $verificador + 1;
    }
    if ($verificador < 3) {
        return true;
    } else {
        return false;
    }
}

function habilitarBotaoSolicitar($conexao, $id, $data_hoje, $refeicao) {
    $sql_ficha = "SELECT * FROM ficha WHERE aluno_id = '$id' AND data_ficha = '$data_hoje' AND pendente = '1' AND refeicao = '$refeicao'";
    $verificador = 0;
    $query_ficha = mysqli_query($conexao, $sql_ficha);
    while ($linha = mysqli_fetch_assoc($query_ficha)) {
        $verificador = 1;
    }

    $verificarQuantidadeFichas = verificarQuantidadeFichas($conexao, $data_hoje, $refeicao);
    if ($verificarQuantidadeFichas) {
        if ($verificador == 0) {
            return true;
        } else {
            return false;
        }
    }
}

function habilitarBotaoCancelar($conexao, $id, $data_hoje, $refeicao) {
    $sql_ficha = "SELECT * FROM ficha WHERE aluno_id = '$id' AND data_ficha = '$data_hoje' AND pendente = '1' AND refeicao = '$refeicao'";
    $verificador = 0;
    $query_ficha = mysqli_query($conexao, $sql_ficha);
    while ($linha = mysqli_fetch_assoc($query_ficha)) {
        $verificador = 1;
    }
    if ($verificador == 1) {
        return true;
    } else {
        return false;
    }
}

function debitarFichaAluno($conexao, $aluno_id, $data_hoje, $refeicao) {
    $pendente = 0;
    $verificarReserva = verificarReserva($conexao, $aluno_id, $data_hoje, $refeicao);
    if ($verificarReserva) {
        $sqlDebitarFicha = "UPDATE ficha SET
				pendente = '$pendente'
				WHERE aluno_id = '$aluno_id' AND data_ficha = '$data_hoje' AND refeicao = '$refeicao'";
        //executa as duas querys
        $query = $conexao->query($sqlDebitarFicha);
        //commit transaction */
        $conexao->commit();
        echo "Verde";
    } else {
        echo "Vermelho";
    }
}

function verificarBiometria($conexao, $aluno_id) {
    $sql_biometria = "SELECT * FROM alunos WHERE id = '$aluno_id' ";
    $query_biometria = mysqli_query($conexao, $sql_biometria);
    while ($linha = mysqli_fetch_assoc($query_biometria)) {
        $biometria = $linha['biometria'];
        $cpf = $linha['cpf'];
    }
    if ($biometria != NULL || $cpf != "") {
        return true;
    } else {
        return false;
    }
}

function validaCPF($cpf) {

    // Extrai somente os números
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {{
            return false;
        }
        }
    }
    return true;
}


?>
