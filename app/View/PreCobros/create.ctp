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
                    <h1>Datos Provisi&oacute;n</h1>
                    <ol class="breadcrumb">
                        <li><a href="/sigest/"><i class="fa fa-home"></i> Inicio</a></li>
                        <li class="active">Datos Provisi&oacute;n</li>                    
                    </ol>                  
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="box">
                                <?php echo $this->Session->flash(); ?>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($consultas as $con): ?>
                                                    <tr>                                                            
                                                        <td data-title="#"><?php echo $con[0]['a_nombre_de']; ?></td>
                                                        <td data-title="#"><?php echo $con[0]['ruc_de']; ?></td>
                                                        <td data-title="#"><?php echo $con[0]['prefecha']; ?></td>
                                                        <td data-title="#"><?php echo $con[0]['sed_nombre']; ?></td>
                                                        <td data-title="#"><?php echo number_format($con[0]['total'], 0, ",", "."); ?></td>
                                                        <td data-title="#"><?php echo $con[0]['estado']; ?></td>
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
                        <div class="row">
                            <div class="box">
                                <div class="box-body">
                                    <div id="iframe-container">                  
                                        <div class="alert alert-info">
                                            <p><span class="glyphicon glyphicon-info-sign"></span> Aguarde mientras se carga el formulario embebido.</p>                
                                        </div> 
                                        <div class="loader"><div class="loader_ajax_small"></div></div>										
                                    </div>  														
                                </div> 
                                <div class="box-footer">
                                    <a href="/sigest/pre_cobros" type="button" class="btn btn-default pull-left" id="btn-cancelar"><span class="glyphicon glyphicon-chevron-left"></span> VOLVER</a>            
                                </div>                                  
                            </div> 
                        </div> 
                    </div>                  
                </section>                
            </div><!-- /.content-wrapper -->          
            <?php echo $this->element('footer'); ?><!--ARCHIVOS JS-->

        </div><!-- ./wrapper -->

        <?php echo $this->element('js'); ?><!--ARCHIVOS JS-->
        <script src="https://vpos.infonet.com.py:8888/checkout/javascript/dist/bancard-checkout-1.0.0.js"></script>
        <script type="application/javascript"> 
            styles = {
            "form-background-color": "#001b60",
            "button-background-color": "#4faed1",
            "button-text-color": "#fcfcfc",
            "button-border-color": "#dddddd",
            "input-background-color": "#fcfcfc",
            "input-text-color": "#111111","input-placeholder-color": "#111111"};
            window. onload= function () {Bancard.Checkout.createForm ('iframe-container', '<?php echo $resp ?>', styles);};
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
