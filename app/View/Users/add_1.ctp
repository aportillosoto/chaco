<!DOCTYPE html>
<html>
    <head>
        <title>Nuevo usuario</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="/certificacion/favicon.ico">
        <link rel="stylesheet" href="/certificacion/js/jquery.mobile-1.4.4/jquery.mobile-1.4.4.min.css" />
        <script src="/certificacion/js/jquery-1.11.1.min.js"></script>
        <script src="/certificacion/js/jquery.mobile-1.4.4/jquery.mobile-1.4.4.min.js"></script>
        <style type="text/css">
            /*table td {
                line-height: 1.5em;
                text-align: left;
                padding: .4em .5em;
                vertical-align: top;
                border-bottom: 1px solid #AAAAAA !important;
            }*/
            table td{
                vertical-align: top !important;
            }
            .ui-controlgroup{
                margin: -1;
            }
            .ui-dialog-contain {
                width: 92.5%;
                max-width: 500px;
                margin: 5% auto 1em;
                padding: 0;
                position: relative;
                top: -1em;
            }
        </style>
    </head>
    <body class="ui-mobile-viewport ui-overlay-a">
        <div data-role="page" data-dialog="true" data-close-btn="right">
            <div data-role="header" data-position="fixed">
                <h2>Nuevo usuario</h2>
            </div>
            <div role="main" class="ui-content">
                <form action="/certificacion/users/add" method="post" accept-charset="utf-8" data-ajax="false">
                    <strong>Nombre de usuario:</strong>
                    <input type="text" name="data[User][username]" required />
                    <br>
                    <strong>Contraseña:</strong>
                    <input type="password" name="data[User][password]" required />
                    <input type="hidden" name="data[User][usu_estado]" value="ACTIVO" />
                    <input type="hidden" name="data[User][id_funcio]" value="0" />
                    <br>
                    <strong>Grupo:</strong>
                    <select name="data[User][grupo]" data-native-menu="false">
                        <?php foreach ($grupos as $grupo):?>
                        <option value="<?php echo $grupo[0]['grup_id'];?>"><?php echo $grupo[0]['grup_nombre'];?></option>
                        <?php endforeach;?>
                    </select>
                    <br>
                    <div data-role="controlgroup" data-type="horizontal" align="center" data-theme="c">
                        <input type="reset" value="Limpiar" data-icon="delete" />
                        <input type="submit" value="Guardar" data-icon="check" data-iconpos="right" />
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>



