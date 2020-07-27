<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/sigest/favicon.png">
        <title>SIGEST</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php echo $this->element('css'); ?><!--ARCHIVOS CSS-->
        <style>   
            .td-nivel-5 {background: #9C9C9C !important;color:black !important;}
        </style> 
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php echo $this->element('header'); ?><!--CABECERA PRINCIPAL-->
            <?php echo $this->element('toolbar'); ?><!--MENU PRINCIPAL-->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>Cuentas Provisionadas</h1>
                    <ol class="breadcrumb">
                        <li><a href="/sigest/"><i class="fa fa-home"></i> Inicio</a></li>
                        <li class="active">Cuentas Provisionadas</li>                    
                    </ol>                  
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="box">
                                <?php echo $this->Session->flash(); ?>
                                <input type="hidden" id="ancla_seleccionado">
                                <div class="box-body">
                                    <?php if (!empty($consultas)) { ?>
                                        <table class=" table table-bordered table-striped dt-responsive tablas" width="100%">
                                            <thead>
                                                <tr>                                                        
                                                    <th>A nombre de</th>
                                                    <th>RUC/CI</th>
                                                    <th>Fecha/Venc.</th>
                                                    <th>Sede</th>
                                                    <th>Total</th>
                                                    <th>Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($consultas as $con): ?>
                                                    <tr>                                                            
                                                        <td data-title=">A nombre de"><?php echo $con[0]['a_nombre_de']; ?></td>
                                                        <td data-title="RUC/CI"><?php echo $con[0]['ruc_de']; ?></td>
                                                        <td data-title="Fecha/Venc."><?php echo date("d/m/Y H:m", strtotime($con[0]['pre_fecha'])) . "<br>" . date("d/m/Y H:m", strtotime($con[0]['pre_venc'])); ?></td>
                                                        <td data-title="Sede"><?php echo $con[0]['sed_nombre']; ?></td>
                                                        <td data-title="Total"><?php echo "Gs. ".number_format($con[0]['total'], 0, ",", "."); ?></td>
                                                        <td data-title="Estado"><?php echo $con[0]['estado']; ?></td>
                                                        <td data-title="Acciones" class="text-center">                                               
                                                            <?php if ($con[0]['origen_pago'] === 'VPOS') { ?>
                                                                <a onclick="pago(<?php echo $con[0]['nro_pcobro']; ?>,'N')" 
                                                                   class="btn btn-primary" role="button" data-title="Abonar" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#mymodal"><i class="fa fa-credit-card"></i></a>                                                                                                                               
                                                               <?php } ?>
                                                            <?php if ($con[0]['origen_pago'] === 'ZIMPLE') { ?>
                                                                <a onclick="pago(<?php echo $con[0]['nro_pcobro']; ?>,'S')" 
                                                                   class="btn btn-primary" role="button" data-title="Abonar" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#mymodal"><i class="fa fa-credit-card"></i></a>                                                                                                                               
                                                               <?php } ?>                                                            
                                                            <a onclick="anular(<?php echo "'" . $con[0]['nro_pcobro'] . "_" . $con[0]['total'] . "'"; ?>)" 
                                                               class="btn btn-danger" role="button" data-title="Anular" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#anular"><i class="fa fa-close"></i></a>                                                            
                                                            <a onclick="editar(<?php echo $con[0]['nro_pcobro']; ?>)" class="btn btn-warning" role="button" data-title="Editar" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#mymodal"><i class="glyphicon glyphicon-edit"></i></a>
                                                            <a onclick="det(<?php echo $con[0]['nro_pcobro']; ?>)" class="btn btn-success" role="button" data-title="Detalles" data-placement="top" rel="tooltip"><i class="glyphicon glyphicon-list"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <div class="alert alert-info flat">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            No posee cuentas provisionadas...
                                        </div>
                                    <?php } ?>
                                </div><!-- /.box-body -->
                            </div>                                                
                        </div>
                    </div>
                    <div id="div_view">                  
                            <div class="alert alert-success"><span class="glyphicon glyphicon-info-sign">                            
                                </span> Para realizar el pago de la provisi&oacute;n puede hacerlo de las siguientes formas:
                            <ul><strong><em>Medios de Pago</em></strong>
                            <li>En cualquier boca de cobranzas <b>AquiPago</b>.</li>
                            <li>Por medio de la aplicación de <b>Pago M&oacute;vil de Bancard</b>.</li>
                            <li>Por los servicios <b>HomeBanking</b> de entiendades financieras.</li>
                            <li>Mediante el formulario embebido del <b>POS Online</b>.</li>
                            <li>Mediante el formulario embebido de <b>Billetera Zimple</b>.</li>
                            </ul>
                            </div>

                    </div>                    
                </section>                
            </div><!-- /.content-wrapper -->
            <div class="modal fade" id="mymodal" role="dialog" aria-labelledby="edit" aria-hidden="true" style="overflow-y: scroll;">
                <div class="modal-dialog">
                    <div class="modal-content" id="detalles">

                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>             
            <div class="modal fade" id="anular" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger" id="confirmaciona"></div>

                        </div>
                        <div class="modal-footer ">
                            <a id="sia" role="button" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>            
            <?php echo $this->element('footer'); ?><!--ARCHIVOS JS-->

        </div><!-- ./wrapper -->

        <?php echo $this->element('js'); ?><!--ARCHIVOS JS-->
        <script>
            function det(nro) {
                $.ajax({
                    type: "GET",
                    url: "/sigest/pre_cobros/details/" + nro,
                    beforeSend: function () {
                        $("#div_view").html('<div class="rating-flash center_loader"><strong>Obteniendo detalles...</strong><img src="/sigest/img/loader.gif"></div>');
                    },
                    success: function (msg) {
                        $("#div_view").html(msg);
                    }
                });
            }
            ;
            function creates(nropre, monto) {
                $('#si').attr('href', '/pre_cobros/create/' + nropre);
                $('#confirmacion').html('<p><span class="glyphicon glyphicon-warning-sign"></span> Desea realizar el pago de la provisión con un monto de <strong> Gs. ' + currency(monto, 0, '.') + '</strong> ?</p>');

            }
            ;
            function solicitar(datos) {
                var dat = datos.split("_");
                $('#si').attr('data-solic', dat[0] + '_' + dat[1]);
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
        Desea realizar el pago de la provisión por un monto de <strong> Gs. ' + currency(dat[1], 0, '.') + '</strong> ?');
            }
            ;
            $('#si').bind('click', function () {
                var datos = $(this).attr('data-solic');
                var dat = datos.split("_");
                $.ajax({
                    type: "GET",
                    url: '/sigest/pre_cobros/create/' + dat[0],
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#div_view').html('<div class="rating-flash center_loader"><strong>Aguarde...</strong><img src="/sigest/img/loader.gif"></div>');
                    },
                    success: function (data) {
                        $('#div_view').html(data);
                    }
                })
            });
            function anular(datos) {
                var dat = datos.split("_");
                $('#sia').attr('href', '/sigest/pre_cobros/anular/' + dat[0]);
                $('#confirmaciona').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
        Desea anular la provisi&oacute;n de pago con monto de <strong>Gs. ' + currency(dat[1], 0, '.') + '</strong> ?');

            }
            ;
            function editar(nro) {
                $.ajax({
                    type: "GET",
                    url: "/sigest/pre_cobros/editar/" + nro,
                    cache: false,
                    beforeSend: function () {
                        //$('#detalles').html('<img src="/sigest/img/ajax-loader(3).gif">  <strong><i>Cargando...</i></strong>');
                        $("#detalles").html('<div class="loader"><div class="loader_ajax_small"></div></div>');
                    },
                    success: function (msg) {
                        $('#detalles').html(msg);
                    }
                });
            };
            function pago(nro,tipo) {
                $.ajax({
                    type: "GET",
                    url: "/sigest/pre_cobros/pay/" + nro+"/"+tipo,
                    cache: false,
                    beforeSend: function () {
                        //$('#detalles').html('<img src="/sigest/img/ajax-loader(3).gif">  <strong><i>Cargando...</i></strong>');
                        $("#detalles").html('<div class="loader"><div class="loader_ajax_small"></div></div>');
                    },
                    success: function (msg) {
                        $('#detalles').html(msg);
                    }
                });
            };            
        </script>                
        <script>
            $("document").ready(function () {
                if ("<?php echo $_SESSION['mensaje'] ?>" !== null) {
                    var mensaje = "<?php echo $_SESSION['mensaje'] ?>".split("_");
                    var tipo;
                    var icono;
                    switch (mensaje[1]) {
                        case '1':
                            tipo = 'success';
                            icono = 'glyphicon glyphicon-file';
                            break;
                        case '2':
                            tipo = 'warning';
                            icono = 'glyphicon glyphicon-pencil';
                            break;
                        case '3':
                            tipo = 'danger';
                            icono = 'glyphicon glyphicon-trash';
                            break;
                        default:
                            tipo = 'info';
                            icono = 'glyphicon glyphicon-info-sign';
                    }
                    if (mensaje[0] !== '') {
                        $.notifyDefaults({
                            type: tipo,
                            delay: '3000',
                            allow_dismiss: true
                        });
                        $.notify(
                                {
                                    icon: icono,
                                    message: mensaje[0]
                                }
                        , {
                            animate: {
                                enter: 'animated lightSpeedIn',
                                exit: 'animated lightSpeedOut'
                            }
                        });
                    }
                }

            });
            "<?php $_SESSION['mensaje'] = null; ?>";
        </script>        
        <div id="IrArriba">
            <div align="left">
                <span id="arriba"><a href='#Ancla'></a></span>
            </div>
        </div>
    </body>
</html>
