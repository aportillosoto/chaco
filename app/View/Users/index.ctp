<!DOCTYPE html>
<html>
    <head>
        <title>Usuarios</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="/certificacion/favicon.ico">
        <link rel="stylesheet" href="/certificacion/js/jquery.mobile-1.4.4/jquery.mobile-1.4.4.min.css" />
        <script src="/certificacion/js/jquery-1.11.1.min.js"></script>
        <script src="/certificacion/js/jquery.mobile-1.4.4/jquery.mobile-1.4.4.min.js"></script>
        <script type="text/javascript">
            $(document).on("pagecreate", "#usuarios", function() {
                $(document).on("swipeleft swiperight", "#usuarios", function(e) {
                    if ($(".ui-page-active").jqmData("panel") !== "open") {
                        if (e.type === "swiperight") {
                            $("#menu").panel("open");
                        }
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $("document").ready(function() {
                //window.setTimeout('jQuery("#popupBasic").popup("open",{transition: "pop"});', 1000);
                window.setTimeout('jQuery("#flashMessage").hide("blind");', 3000);
            });
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery(".acciones").bind("click", function() {
                    var id = jQuery(this).attr('id');
                    var dat = id.split("_");
                    jQuery('#estado').html('Est&aacute; seguro de borrar <i>' + dat[1] + '</i>?');
                    jQuery('#confirmar').attr('href', '/certificacion/users/delete/' +  dat[0]);
                });
            });
        </script>
        <style>
            .ui-btn-icon-notext.ui-corner-all {
                -webkit-border-radius: .3125em;
                border-radius: .3125em;
            }
            .ui-title{
                white-space: normal !important;
                margin:0 2% !important;
            }
/*            .ui-controlgroup-controls .ui-btn-icon-notext {
                height: auto;
                padding: .5em 0.5em;
            }*/
        </style>
    </head>
    <body class="ui-mobile-viewport ui-overlay-a">
        <div data-role="page" id="usuarios">
            <?php echo $this->element('menu'); ?><!--MENU PRINCIPAL-->
            <div data-role="header" data-position="fixed">
                <h2>Usuarios</h2>
                <a href="#menu" class="ui-btn-left ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ui-icon-grid">Menu</a>
                <a href="/certificacion/" data-ajax="false" class="ui-btn-right ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ui-icon-back">Volver</a>
            </div>
            <div role="main" class="ui-content">
                <?php echo $this->Session->flash(); ?>
                <?php if (!empty($usuarios)) { ?>
                    <div align="right" style="margin:-10px;margin-bottom: 2px;">
                        <a href="/certificacion/users/add/" data-inline="true" data-role="button" data-icon="plus" data-iconpos="right" data-mini="true" data-ajax="false">Nuevo</a>    
                    </div>
                    <?php echo $this->element('search', array("formulario" => "/certificacion/users/", 'modelo' => 'User')); ?><!--BUSCAR-->
                    <table data-role="table" data-mode="columntoggle" 
                           class="ui-body-a ui-shadow table-stripe ui-responsive" 
                           data-column-btn-theme="b" data-column-btn-text="Columns to display..." 
                           data-column-popup-theme="a" style="font-size:14px;">
                        <thead class="ui-bar-a">
                            <tr>
                                <th>Direcci&oacute;n Ip</th>
                                <th style="text-align: center;">Usuario</th>
                                <th style="text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td style="vertical-align:middle;"><?php echo $usuario[0]['username']; ?></td>
                                    <td style="vertical-align:middle;text-align: center;"><?php echo $usuario[0]['grup_nombre']; ?></td>
                                    <td class="actions" style="text-align: center;">
                                        <div data-role="controlgroup" data-type="horizontal" data-mini="true">
                                            <a href="/certificacion/users/edit/<?php echo $usuario[0]['id']; ?>" class="ui-btn ui-corner-all" data-ajax="false">Editar</a>
                                            <a href="#borrar" id="<?php echo $usuario[0]['id']; ?>_<?php echo $usuario[0]['username']; ?>" data-rel="popup" data-position-to="window" data-transition="slide" class="acciones ui-btn ui-corner-all">Borrar</a>
                                            <a href="/certificacion/users/asignaobra/<?php echo $usuario[0]['id']; ?>" class="ui-btn ui-corner-all" data-ajax="false">Asignar obra</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="ui-bar ui-bar-a">
                        <strong style="text-align:center;color: steelblue;float: left;margin-top: 1.5%;">No se han registrado usuarios...</strong>
                        <div style="float:right;margin-bottom: 7px;" data-role="controlgroup" data-type="horizontal" data-mini="true">
                            <a href="/certificacion/users/add/" data-inline="true" data-role="button" data-icon="plus" data-iconpos="right" data-ajax="false">Nuevo</a>    
                        </div>
                    </div>
                <?php } ?>
                <div data-role="popup" id="borrar" data-overlay-theme="b" data-theme="a" data-dismissible="false" style="min-width:350px;">
                    <!--<a data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Cerrar</a>-->
                    <div data-role="header" data-theme="a" class="ui-corner">
                        <!--<img width="30" class="ui-li-icon" id="bandpais" src="" alt="">-->
                        <h1>Borrar usuario</h1>
                    </div>
                    <div role="main" class="ui-content">
                        <h5 class="ui-title" id="estado" style="white-space:normal !important;"></h5>
                        <br>
                        <div data-role="controlgroup" data-type="horizontal" data-mini="true" data-theme="a" align="center">
                            <a data-rel="back" data-role="button" data-inline="true">Cancelar</a>
                            <a id="confirmar" href="" data-ajax="false" data-role="button" data-inline="true">Aceptar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
