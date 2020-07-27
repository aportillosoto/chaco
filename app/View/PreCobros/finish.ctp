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
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-lg-4">
                                <?php //debug($transaccion) ?>
                                <div class="box box-success">         
                                    <div class="box-body">
                                        <table class="table dt-responsive" width="100%">
                                            <thead>
                                                <tr class="success">
                                                    <th colspan="2" class="text-center"><i class="fa fa-check-circle"></i> Transacci&oacute;n Exitosa</th>
                                                </tr>
                                            </thead>                                        
                                            <tbody>
                                                <?php foreach ($transaccion as $t): ?>

                                                    <tr> 
                                                        <th class=>N° Ticket:</th>
                                                        <td><?php echo $t[0]['ticket_number']; ?></td>                                                        
                                                    </tr>	
                                                    <tr>                                                       
                                                        <th class=>Fecha y hora:</th>
                                                        <td><?php echo date("d/m/Y H:m", strtotime($t[0]['precobro_date'])); ?></td>
                                                    </tr>   
                                                    <tr>                                                       
                                                        <th class=>R.U.C / C.I:</th>
                                                        <td><?php echo $consultas[0][0]['ruc_de']; ?></td>
                                                    </tr>  
                                                    <tr>                                                       
                                                        <th class=>Nombres:</th>
                                                        <td><?php echo $consultas[0][0]['a_nombre_de']; ?></td>
                                                    </tr> 
                                                    <tr>                                                       
                                                        <th class=>Concepto:</th>
                                                        <td><?php echo "Pago aranceles";  ?></td>
                                                    </tr>                                                 
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="active">
                                                    <td><label class="pull-left control-label">TOTAL: </label></td>
                                                    <td class="text-center"><?php echo "<strong>" . number_format($t[0]['amount'], 0, ",", ".") . "</strong>"; ?></td>
                                                </tr>
                                            </tfoot>														
                                        </table>                                        
                                    </div>
                                    <div class="box-footer">
                                        <a href="/sigest/" role="button" onclick="cuenta()" class="btn btn-primary pull-left" data-title="Volver al Portal" data-placement="top" rel="tooltip"><i class="fa fa-home"></i> VOLVER</a>                                                
                                        <button onclick="confirmar()" class="btn btn-danger pull-right" role="button" data-title="Descargar" data-placement="top" rel="tooltip"> <i class="fa fa-file-pdf-o"></i> DESCARGAR</button>
                                    </div>                                    
                                </div>                                                
                            </div>                            
                        </div>

                    </div>
                </section>                
            </div><!-- /.content-wrapper -->

            <?php echo $this->element('footer'); ?><!--ARCHIVOS JS-->

        </div><!-- ./wrapper -->

        <?php echo $this->element('js'); ?><!--ARCHIVOS JS-->

        <div id="IrArriba">
            <div align="left">
                <span id="arriba"><a href='#Ancla'></a></span>
            </div>
        </div>
    </body>
</html>
