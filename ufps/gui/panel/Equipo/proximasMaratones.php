<?php
session_start();
if (isset($_SESSION["admin"]) || isset($_SESSION["docente"]) || isset($_SESSION["maraton"])) {
    header("Location: ../visualizar/visualizarRankingGeneral.php");
}
if ($_SESSION["equipo"]["mostrar"] == -1) {
    header("Location: procesar/procesarProximasMaratones.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="../../materialize/css/ufps.min.css"/>
        <link type="text/css" rel="stylesheet" href="../../materialize/css/estilo.css"/>
        <link type="text/css" rel="stylesheet" href="../../materialize/css/AdminLTE.min.css"/>
        <script type="text/javascript" src="../../materialize/js/jquery-3.1.0.js"></script>
        <script type="text/javascript" src="../../materialize/js/ufps.min.js"></script>
        <script src="js/equipo.js"></script>
        <title>Proximas Maratones</title>
    </head>
    <body background="../../imagenes/main-bg.png">
        <?php
        require_once '../../utilidad/procesarCabecera.php';
        ?>
        <div class="ufps-container">
            <div class="ufps-panel" >
                <form name="formulario" id="formulario" action="" method="post">
                    <h1 class="ufps-text-center">Proximas Maratones</h1>
                    <table class="ufps-table ufps-table-inserted ufps-text-center">
                        <thead>
                            <tr>
                                <th data-field="nombre">Nombre</th>
                                <th data-field="fechaI">Fecha de Inicio</th>
                                <th data-field="horaI">Hora de Inicio</th>
                                <th data-field="fechaF">Fecha del Final</th>
                                <th data-field="horaF">Hora del Final</th>
                                <th data-field="inscribirse">Inscribirse</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            echo $_SESSION["equipo"]["mostrar"];
                            $_SESSION["equipo"]["mostrar"] = -1;
                            ?>
                        </tbody>
                    </table>
                </form>
                <div class="ufps-alert" id="notificacion">
                    <span class="ufps-close-alert-btn">x</span>
                    <span id="mensaje"> Alerta de ejemplo.</span>
                </div>
            </div>
        </div>
        <section class="content"></section>
        <?php
        include_once '../../utilidad/piepagina.php';
        ?>
    </body>
</html>
