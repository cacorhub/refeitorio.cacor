<?php 

include("headers.php");
?>
<body>
    <?php
    include("menus_adm.php");
    include("conexao.php");
    ?>

    <!-- Conteudo da página principal... -->
    <div class='container'>
        <div class='row'>
            <div class='col s12'>
                <?php
                // Exibir mensagem de erro caso ocorra.
                if (isset($_GET["erro"])) {
                    $erro = $_GET["erro"];
                    echo "<div class='chip yellow'>$erro</div>";
                }
                ?>
                <h3>Cadastro de Alunos</h3>
            </div>
        </div>
        <div class="row">

            <?php
            // Trazendo dados preenchidos no formulário para alteração.
            if (!empty($_POST['nome'])) {
                $matricula = $_POST['matricula'];
                $turno = $_POST['turno'];
                $nome = strtoupper($_POST['nome']);
                $sexo = $_POST['sexo'];
                $data_nascimento = $_POST['data_nascimento'];
                $cpf = $_POST['cpf'];
                $rg = $_POST['rg'];
                $telefone = $_POST['telefone'];
                $email = strtolower($_POST['email']);
                $foto = $_FILES['foto']['name'];
                if (validaCPF($cpf)) {
                    $sql = "insert into alunos (ativo, matricula, turno, nome, sexo, data_nascimento, cpf, rg, telefone, email, login, senha, arquivo_foto) values
                                  ('1','$matricula', '$turno', '$nome', '$sexo', '$data_nascimento', '$cpf', '$rg', '$telefone', '$email', '$matricula', '$matricula', '$foto')";
                    
                    mysqli_query($conexao, $sql);
                    echo "<h4 style='color: blue'>Cadastrado com sucesso!</h4>";
                } else {
					echo "<h4 style='color: red'>Usuário não cadastrado!</h4>";
                }
               
            }
            ?>


            <script type="text/javascript">


                 function TestaCPF(elemento) {
                    cpf = elemento.value;
                    cpf = cpf.replace(/[^\d]+/g, '');
                    if (cpf == '') {                     
                        return alert("CPF Inválido"), elemento.style.borderBottom = "1px solid #F44336";
                    }

                      // Elimina CPFs invalidos conhecidos    
                    if (cpf.length != 11 ||
                        cpf == "00000000000" ||
                        cpf == "11111111111" ||
                        cpf == "22222222222" ||
                        cpf == "33333333333" ||
                        cpf == "44444444444" ||
                        cpf == "55555555555" ||
                        cpf == "66666666666" ||
                        cpf == "77777777777" ||
                        cpf == "88888888888" ||
                        cpf == "99999999999") {

                        return alert("CPF Inválido"), elemento.style.borderBottom = "1px solid  #F44336";
                    }
                      // Valida 1o digito 

                    add = 0;
                    for (i = 0; i < 9; i++) {                       
                        add += parseInt(cpf.charAt(i)) * (10 - i);
                    }

                    rev = 11 - (add % 11);

                    if (rev == 10 || rev == 11) {                      
                        rev = 0;
                    }

                    if (rev != parseInt(cpf.charAt(9))) {                     
                        return alert("CPF Inválido"), elemento.style.borderBottom = "1px solid  #F44336";
                    }

                      // Valida 2o digito 
                    add = 0;

                    for (i = 0; i < 10; i++) {                     
                        add += parseInt(cpf.charAt(i)) * (11 - i);
                    }

                    rev = 11 - (add % 11);

                    if (rev == 10 || rev == 11) {                  
                        rev = 0;
                    }

                    if (rev != parseInt(cpf.charAt(10))) {                      
                       return alert("CPF Inválido"), elemento.style.borderBottom = "1px solid  #F44336";
                    }

                    return elemento.style.borderBottom = "1px solid #26a69a";
                }

              </script>



            <form id="meuform" action='cadastro_alunos.php' method='post' enctype='multipart/form-data' onsubmit="VerificaCPF();">
                <div class='input-field col s12' >
                    <input class='validate' type='text' id='matricula' name='matricula' required>
                    <label for='nome'>Matricula:</label>
                </div>
                <div class='input-field col s12'>
                    <select name='turno' id='turno'>
                        <option value='Manha'>Manha</option>
                        <option value='Tarde'>Tarde</option>
                        <option value='Noite'>Noite</option>
                        <option value='Integral'>Integral</option>
                        <option value='EAD'>EAD</option>
                        <option value='POS'>POS</option>
                    </select>
                    <label>Turno:</label>
                </div>
                <div class='input-field col s12'>
                    <input class='validate' type='text' id='nome' name='nome' required >
                    <label for='nome'>Nome completo:</label>
                </div>
                <div class='input-field col s12'>
                    <input class='validate' type='email' id='email' name='email'>
                    <label for='email'>E-mail:</label>
                </div>
                <div class='input-field col s12'>
                    <input class='validate' type='text' id='telefone' name='telefone'>
                    <label for='telefone'>Telefone:</label>
                </div>
                <div class='input-field col s12'>
                    <select name='sexo' id='sexo'>
                        <option value='M'>Masculino</option>
                        <option value='F'>Feminino</option>
                        <option value=' '>Não informado</option>
                    </select>
                    <label> Sexo:</label>
                </div>
                <div class='input-field col s12'>
                    <input class='validate' type='text' name='rg' id='rg'>
                    <label  for='rg'>Número do RG:</label>
                </div>
                <div class='input-field col s12' id="teste">
                    <input class='validate' type='text' id='cpf' name='cpf' onblur="return TestaCPF(this)" maxlength="11" required>
                    <label  for='cpf'>CPF:</label>
                </div>

                Data de Nascimento:
                <div class='input-field col s12'>

                    <input class='' type='date' id='data_n' name='data_nascimento' required>
                </div>
                <div class='file-field input-field col s12'>
                    <div class='btn'>
                        <input class='file-path validate' type='file' id='take-picture' accept='image/*' name='foto'>
                        <span>Arquivo de imagem:</span>
                    </div>
                    <img src='' alt='' id='show-picture' class='preview'>
                </div>
                <div class="col s12">
                    <input type="submit" class="btn" value="Cadastrar Aluno" onclick="return TestaCPF(cpf)">
                </div>
            </form>

            <script src="js/base.js"></script>
        </div>

    </div>


</div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->



</body>

<?php
include("extends.php");
?>

</html>
