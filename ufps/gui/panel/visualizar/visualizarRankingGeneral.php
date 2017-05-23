<?php
session_start();
if (isset($_SESSION["maraton"])) {
    if (isset($_SESSION["maraton"]["usuario"])) {
        header("Location: ../Maraton/maraton.php");
    }
    header("Location: ../visualizar/cerrarSesion.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="../../materialize/css/ufps.min.css"/>
        <link type="text/css" rel="stylesheet" href="../../materialize/css/estilo.css"/>
        <title>Ranking General</title>
    </head>
    <body background="../../imagenes/main-bg.png">
        <?php
        require_once '../../utilidad/procesarCabecera.php';
        ?>
        <div class="ufps-container">
            <div class="ufps-panel">
                <form method="post" action="" id="formulario" name="formulario">
                    <div class="ufps-row">
                        <div class="ufps-col-12">
                            <h1 class="ufps-text-center ">Ranking General</h1>
                            <table class="ufps-table ufps-table-inserted ufps-text-center">
                                <thead>
                                    <tr>
                                        <th data-field="posicion">Posicion</th>
                                        <th data-field="nombre">Nombre</th>
                                        <th data-field="resueltos">Resueltos</th>
                                        <th data-field="resueltos">Intentos</th>
                                        <th data-field="resueltos">Envios</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>lo que sea</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        include_once '../../utilidad/piepagina.php';
        ?>
        <script type="text/javascript" src="../../materialize/js/jquery-3.1.0.js"></script>
        <script type="text/javascript" src="../../materialize/js/ufps.min.js"></script>
    </body>
</html>
