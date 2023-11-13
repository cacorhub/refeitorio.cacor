<?php
    include("headers.php");
 ?>   
<body onload="pisca();"> <div class="container" >
        <div class="row">
          <div class="col s12">
                <form action="index.php" method="post">
                    <img src="img/logo.png" class="logo centralizado">
                    <h3 class="center">Login</h3>
			<!-- <div class="pesquisa">
				<a id="led_pisca" href="https://forms.gle/WFdPdAEUiUk62MMU8">Pesquisa de Satisfa&ccedil;&atilde;o</a>
			</div>-->
                    <div class="center">
                        <?php
                            // Exibir mensagem de erro caso ocorra.
                            if (isset($_GET["erro"]))  {
                                $erro = $_GET["erro"];
                                echo  "<div class='chip yellow alert'>$erro</div>";
                            }
                        ?>
                    </div>
                    <div class="input-field col s12 center">
                        <input id="login" type="text" class="validate grande" name="login" required>
                        <label for="login">Login</label>
                    </div>
                    <div class="input-field col s12 center">
                        <input class="validate grande" type="password" id="senha" name="senha" required>
                        <label for="nome">Senha</label>
                    </div>
                    <div class="row">
                        <div class="col s12 center">
                            <input class="waves-effect waves-light btn" type="submit" value="Entrar">
                        </div>
                    </div>
                </form>
                <!--  Final do formulário -->
                <?php
                    include("conexao.php");
                    // as variáveis login e senha recebem os dados digitados na página anterior
                    if (!empty($_POST)) {
                         $login = $_POST['login'];
                         $senha = $_POST['senha'];

                        $login = str_replace(str_split(' .'),'',$login); // Retira os "." e qualquer espaço em branco da tring.
                        $senha = str_replace(str_split(' .'),'',$senha);



                        // Pesquisando na tebela de alunos! - PODERÁ DIGITAR A MATRÍCULA E SENHA COM OU SEM OS '.' PONTOS.
                        $sql = "select * FROM `alunos` WHERE (replace(replace(login, '.', ''), ' ', '') = '$login') AND (replace(replace(senha, '.', ''), ' ', '') = '$senha')";
                        $result = $mysqli->query($sql);
                        $encontrado = ($result-> num_rows > 0);
                        if ($encontrado) {
                            while ( $linha = $result->fetch_array()) {
                                $id =   $linha['id'];
            					$nome = $linha['nome'];
                                $foto = $linha['arquivo_foto'];
                                $ativo = $linha['ativo'];
                            }
                            $tipo = "ALUNO";
                        }
                        else { // Se não econtrar aluno procura na tabela de Administrador
                            $sql = "select * FROM `administradores` WHERE `login` = '$login' AND `senha`= '$senha'";
                            $result = $mysqli->query($sql);
                            $encontrado = ($result-> num_rows > 0);
                            if ($encontrado) {
                                while ( $linha = $result->fetch_array()) {
                                    $id =   $linha['id_admin'];
                					$nome = $linha['nome'];
                                    $foto = '/img/admin.jpg';
                                    $ativo = true;
                                }
                                $tipo = "ADM";
                            }
                        }
                        session_start();
                         if (($encontrado ) and ($ativo))     {
                                $_SESSION['id'] = $id;
                                $_SESSION['login'] = $login;
                                $_SESSION['senha'] = $senha;
                                $_SESSION['nome'] = $nome;
                                $_SESSION['foto'] = $foto;
                                $_SESSION['tipo'] = $tipo;
                                unset($_POST);
                                if ($tipo == "ALUNO") {
                                    header('location:solicita_ticket.php');
                                }
                                if ($tipo == "ADM"){
                                    header('location:principal_adm.php');
                                }
                         }
                         else {
                                unset ($_SESSION['login']);
                                unset ($_SESSION['senha']);
                                session_destroy();
                                header('location:index.php?erro=Usuário Inválido');
                    }
                } // Final do IF Empty
                ?>

                <!-- <p class="center">
                    <img src="img/designed-for-chrome.png" alt="Google Chrome"/>
                </p> -->
          </div>
        </div>
        <div class="row">
            <div class="col s12 center">
                <a href="refeitorio_IFPI_Corrente.apk"><img src="img/app_android.jpg" alt="Logo"></a>
            </div>
        </div>
    </div> <!-- FINAL DO CONTAINER -->
    </body>

    <script type="text/javascript">
        // Inicialização para animação dos inputs dos forms de entrada.
        $(document).ready(function() {
            $('input#input_text, textarea#textarea1').characterCounter();
        });
    </script>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

</html>
