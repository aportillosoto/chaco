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
                    <h1><i class="fa fa-tags"></i>Transacciones Realizadas</h1>
                    <ol class="breadcrumb">
                        <li><a href="/sigest/"><i class="fa fa-home"></i> Inicio</a></li>
                        <li class="active">Transacciones Realizadas</li>                    
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
                                                    <th>Fecha</th>
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
                                                        <td data-title="Fecha"><?php echo date("d/m/Y H:m", strtotime($con[0]['pre_fecha'])); ?></td>
                                                        <td data-title="Sede"><?php echo $con[0]['sed_nombre']; ?></td>
                                                        <td data-title="Total"><?php echo "Gs. ".number_format($con[0]['total'], 0, ",", "."); ?></td>
                                                        <td data-title="Estado"><?php echo $con[0]['estado']; ?></td>
                                                        <td data-title="Acciones" class="text-center">                                               
                                                            <?php if (($con[0]['origen_pago'] === 'VPOS' || $con[0]['origen_pago'] === 'ZIMPLE') && $con[0]['estado'] === 'CONFIRMADO') { ?>
                                                            <a onclick="revertir(<?php echo "'" . $con[0]['nro_pcobro'] . "_" . $con[0]['total'] . "'"; ?>)" 
                                                               class="btn btn-danger" role="button" data-title="Revertir pago" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#anular"><i class="fa fa-undo"></i></a>
                                                               <?php } ?>
                                                            <a href="/pre_cobros/ticket/<?php echo $con[0]['nro_pcobro']; ?>" class="btn btn-primary" role="button" data-title="Imprimir" data-placement="top" rel="tooltip" target="_blank"><i class="glyphicon glyphicon-print"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <div class="alert alert-info flat">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            Aún no posee transacciones de pago
                                        </div>
                                    <?php } ?>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <a href="/sigest/pre_cobros/add_transaction" type="button" class="btn btn-success pull-right" id="btn-agregar"><span class="glyphicon glyphicon-plus"></span> AGREGAR PROVISION</a>            
                                </div>                                 
                            </div>                                                
                        </div>
                    </div>
                    <?php if (!empty($consultas)) { ?>
                    <div id="div_view">                  
                        <div class="alert alert-info"><p><span class="glyphicon glyphicon-info-sign"></span> Aqui se detallan los pagos confirmados, si el pago se realizo mediante el <strong>POS ONLINE</strong>
                         es posible realizar la reversi&oacute;n siempre y cuando el estado del mismo sea <strong>CONFIRMADO</strong>, caso contrario puede acudir a su sede donde se le brindar&aacute; más informaci&oacute;n al respecto.</p>
                        </div>

                    </div>
                    <?php } ?>                    
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
            function revertir(datos) {
                var dat = datos.split("_");
                $('#sia').attr('href', '/sigest/pre_cobros/rollback/' + dat[0]);
                $('#confirmaciona').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
                Desea realizar la reversión del pago con monto de <strong>Gs. ' + currency(dat[1], 0, '.') + '</strong> ?');
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
