
<?php
    include("headers.php");
 ?>   

<script type="text/javascript">
    
  if (location.protocol !== 'https:') {
    location.replace(`https:${location.href.substring(location.protocol.length)}`);

}
</script>

</script>


<body onload="pisca();"> <div class="container">

        <div class="painel">
          <div class="col s12">
                <form action="index.php" method="post"/>
               <!--   <img src="img/logo.png" class="logo"> -->
                       <br><br><br><br><br><br>
                     <center>
                        <br><br><br><br><br><br><br><br><br>
                    <div id="caixa" align="center">
                          <img src="img/logo-velhoo.svg" class="logomarca ">
                          
                       <center>
                           
                             <?php
                            // Exibir mensagem de erro caso ocorra.
                            if (isset($_GET["erro"]))  {
                                $erro = $_GET["erro"];
                                echo  "<div class='chip'>$erro</div>";
                            }
                        ?>
                       
                       </center> 
                       
                        <input id="login" type="text" class="validate" name="login" required placeholder="Login">
                        <input class="validate" type="password" id="senha" name="senha" required placeholder="Senha">
                        <input class="btn-large" type="submit" name="enviar" value="Entrar" onclick="return valida()">
					</div>

                 </center> 

						
							<?php
							
								if(isset($_POST['enviar'])){
								//	print_r($_POST);
									if(!empty($_POST['g-recaptcha-response'])){
										$url = "https://www.google.com/recaptcha/api/siteverify";
										$secret = "6LcCHUUlAAAAAMTpBwCnjzK9T8j03uCInAPwDfzK";
										$response = $_POST['g-recaptcha-response'];
										$variaveis = "secret=".$secret."&response=".$response;
										$ch = curl_init($url);
										
										curl_setopt($ch, CURLOPT_POST, 1);
										curl_setopt($ch, CURLOPT_POSTFIELDS, $variaveis);
										curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										$resposta = curl_exec($ch);
										
										
										$resultado = json_decode($resposta);
										
										echo $resultado->success;
									}
								}
								
							?>
							
                        </div>
                    </div>
                </form>
		<br/> 
		
                <?php
                    include("conexao.php");
                    // as variáveis login e senha recebem os dados digitados na página anterior
                    if (!empty($_POST)) {
                       // $login = $_POST['login'];
                       // $senha = $_POST['senha'];
						
						$login = mysqli_real_escape_string($conexao, $_POST['login']);
						$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

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
								$turno = $linha['turno'];
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
								$turno = 'ADM';
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
								$_SESSION['turno'] = $turno;
                                unset($_POST);
                                if ($tipo == "ALUNO") {
                                    header('location:solicita_ticket.php');
                                }
                                if ($tipo == "ADM"){
                                    header('location:principal_adm.php');
                                }
                         }
                         else if (($encontrado ) and (!$ativo)) {
                                unset ($_SESSION['login']);
                                unset ($_SESSION['senha']);
                                session_destroy();
                                header('location:index.php?erro=Usuário Inativo! Procure a CTI (Sala 11) para regularizar sua situação!');
								}else {
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
        <div class="painel">
            <div class="col s12 center">
                <!-- <a href="refeitorio_IFPI_Corrente.apk"><img src="img/app_android.jpg" alt="Logo"></a> -->
            </div>
        </div>
    </div> <!-- FINAL DO CONTAINER -->
    
<!-- 
    Captcha aqui -->

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
