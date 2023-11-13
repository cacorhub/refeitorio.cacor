<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<script type="text/javascript">
    // Inicialização para animação dos inputs dos forms de entrada.
    $(document).ready(function() {
        $('input#input_text, textarea#textarea1').characterCounter();
    });
</script>

<script type="text/javascript">
    // Inicialização para animação dos inputs SELECTS
    $(document).ready(function() {
    $('select').material_select();
    });
</script>

<script type="text/javascript">
    // Formulários - Campus de Datas
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
    });
</script>


<script type="text/javascript">
      // ATIVANDO MENU LATERAL.
       $(".button-collapse").sideNav();
</script>

<script type="text/javascript">
        // Materialize.toast(message, displayLength, className, completeCallback);
        Materialize.toast('', 4000) // 4000 is the duration of the toast
    </script>

    <script type="text/javascript">
        // FAZ FUNCIONAR AS JANELAS MODAIS!
        $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal').modal();});
    </script>

<script type="text/javascript">
    // Menu Dropdown
    $(".dropdown-button").dropdown();
</script>

<script type="text/javascript">
        // Seleciona todos os checkbox
        function selecionar_tudo(){
        var ligado = document.getElementById('todos').checked;
            var X = document.getElementsByClassName("filled-in");
            if ( ligado ) {
                for (i=0;i< X.length; i++) {
                  if (X[i].type == "checkbox") {
                     X[i].checked=1
                    }
                }
            } else {
                for (i=0;i<X.length;i++) {
                  if (X[i].type == "checkbox") {
                     X[i].checked=0
                    }
                }
            }
        } // Fim do script
    </script>
