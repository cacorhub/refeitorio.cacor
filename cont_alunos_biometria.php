<?php
    include("headers.php");
 ?>
    <script src="js/chart.js"></script>
 <body>
    <?php
        include("menus_adm.php");
        include("conexao.php");

     ?>

     <!-- Conteudo da página principal... -->
    <div class='container'>
        <div class='row'>
            <div class='col s12'>
              <h3>Quantidade de cadastros biométricos</h3>
            </div>
        </div>
        <div class="row" >
            <div class="col s6">
                <div class="card-panel  green accent-1">
                    <?php
                      $sql = 'select COUNT(1) from alunos';
                      $query = $mysqli->query($sql);
                      $total = $query->fetch_array();
                      echo "<img src='img/ic_account_circle_black_24dp_1x.png'> ";
                      echo "<strong class='grande'>$total[0]</strong> alunos cadastrados<hr>";

                      $sql = 'select COUNT(1) from alunos where biometria is null';
                      $query = $mysqli->query($sql);
                      $bio = $query->fetch_array();

                      $sql = "select COUNT(1) from `alunos` where not (matricula = senha)";
                      $query = $mysqli->query($sql);
                      $qtd_mudaram_senha = $query->fetch_array();

                      echo "<img src='img/biometria_ok.png'> ";
                      echo "<strong class='grande'>$bio[0]</strong> biometrias cadastradas<br>";
                      $restam = $total[0] - $bio[0];
                      echo "<img src='img/biometria_no.png'> ";
                      echo "<strong class='grande alert'>$restam</strong> faltam fazer o cadastro biométrico";
                     echo "<hr><img src='img/ic_vpn_key_black_24dp_1x.png'> ";
                      echo "<strong class='grande'>$qtd_mudaram_senha[0]</strong> alunos alteraram a senha.";
                    ?>
                </div>
            </div>
            <div class="col s6">
                <div class="card-panel  green accent-1">
                    <canvas id="grafico" width="300" ></canvas>
                </div>
            </div>
        </div>

    </div> <!-- Final da linh "row" -->

    </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->

    <script>new Chart(document.getElementById("grafico"),
        {"type":"doughnut",
        "data":{"labels":["Faltam","Biometria Cadastrada"],
        "datasets":[{"label":"Gráfico em Pizza","data":[<?php echo "$restam, $bio[0]" ?>],
        "backgroundColor":["red","blue"]}]}});
    </script>

  </body>
    <?php
        include("extends.php");
    ?>
</html>
