<?php
    include("headers.php");
	$hoje = date('Y/m/d');
	
	$hora = date("H");
              //echo $hora;
              $data_hora =  date('d/m/Y H:i:s');
              echo "<p class='center'>Data de hoje: " . $data_hora . "</p>";
              $h = "5"; //HORAS DO FUSO ((BRASÍLIA = -5) COLOCA-SE SEM O SINAL -).
              $hm = $h * 60;
              $ms = $hm * 60;

              //COLOCA-SE O SINAL DO FUSO ((BRASÍLIA = -5) SINAL -) ANTES DO ($ms). HORA
              $gmhora = date("H");
			  
			  
	
	
 ?>
 
 
 
<body>
    <div class="container" >
        <div class="row">
          <div class="col s12">
                <form action="index_confirma.php" method="post">
                    <img src="img/logo.png" class="logo centralizado">
                    <h3 class="center">CONFIRMAR ALMOÇO 🍽️</h3>
                     <h2 class="center">INFORME APENAS SUA MATRÍCULA</h2>
                    <div class="center">
                        <?php
						
						 
						
						
                            // Exibir mensagem de erro caso ocorra.
                            if (isset($_GET["erro"]))  {
                                $erro = $_GET["erro"];
                                echo  "<div class='chip yellow alert'>$erro</div>";
								
							
                            }
							
							
							if(!($gmhora >= 11 && $gmhora <= 13)){
				   
									echo  "<div class='chip yellow alert'>Fora do horário de almoço!     </div>";
				    
							} else {
                        ?>
                    </div>
                    <div class="input-field col s12 center">
                        <input id="login" type="text" class="validate grande" name="login" required>
                        <label for="login">Login</label>
                    </div>
                 <!--  <div class="input-field col s12 center">
                        <input class="validate grande" type="password" id="senha" name="senha" required>
                        <label for="nome">Senha</label>
                    </div>-->
                    <div class="row">
                        <div class="col s12 center">
                            <input class="waves-effect waves-light btn" type="submit" value="CONFIRMAR">
                        </div>
                    </div>
                </form>
                <!--  Final do formulário -->
                <?php
							}
                    include("conexao.php");
                    // as variáveis login e senha recebem os dados digitados na página anterior
                    if (!empty($_POST)) {
                         $login = $_POST['login'];
                         $senha = $_POST['senha'];

                        $login = str_replace(str_split(' .'),'',$login); // Retira os "." e qualquer espaço em branco da tring.
                        $senha = str_replace(str_split(' .'),'',$senha);



                        // Pesquisando na tebela de alunos! - PODERÁ DIGITAR A MATRÍCULA E SENHA COM OU SEM OS '.' PONTOS.
                        $sql = "select * FROM `alunos` WHERE (replace(replace(login, '.', ''), ' ', '') = '$login')";
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
									 if (verificarReserva($conexao, $id, $hoje)) {
										 
											debitarFichaAluno($conexao, $id, $hoje);
											
							
											
											 session_destroy();
											 
							
											 
											
											header('location:index_confirma.php?erro=Almoço confirmado! ');
									 }
									 else{
										 header('location:index_confirma.php?erro=Usuário sem Reserva de almoço!');
									 }
                                }
                                if ($tipo == "ADM"){
                                    header('location:principal_adm.php');
                                }
                         }
                         else {
                                unset ($_SESSION['login']);
                                unset ($_SESSION['senha']);
                                session_destroy();
                                header('location:index_confirma.php?erro=Usuário Inválido');
                    }
                } // Final do IF Empty
                ?>

                <!-- <p class="center">
                    <img src="img/designed-for-chrome.png" alt="Google Chrome"/>
                </p> -->
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
