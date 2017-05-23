<?php
session_start();
if (isset($_SESSION["admin"]) || isset($_SESSION["docente"]) || !isset($_SESSION["maraton"])) {
    header("Location: ../visualizar/visualizarRankingGeneral.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="../../materialize/css/ufps.min.css"/>
        <link type="text/css" rel="stylesheet" href="../../materialize/css/estilo.css"/>
        <script src="js/maraton.js"></script>
        <title>Maraton <?php echo $_SESSION["maraton"]["usuario"]; ?></title>
    </head>
    <body background="../../imagenes/main-bg.png">
        <?php
        require_once '../../utilidad/procesarCabecera.php';
        ?>
        <div class="ufps-container">
            <div class="ufps-panel">
                <?php
                include_once '..\visualizar\visualizarRanking.php';
                ?>
                <div class="ufps-alert" id="notificacion">
                    <span class="ufps-close-alert-btn">x</span>
                    <span id="mensaje"> Alerta de ejemplo.</span>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once '../../utilidad/piePagina.php';
    ?>
    <script type="text/javascript" src="../../materialize/js/jquery-3.1.0.js"></script>
    <script type="text/javascript" src="../../materialize/js/ufps.min.js"></script>
</body>
</html>
