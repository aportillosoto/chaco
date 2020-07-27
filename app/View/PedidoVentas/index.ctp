<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/chaco/favicon.png">
        <title>CHACO</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php echo $this->element('css'); ?><!--ARCHIVOS CSS-->
        <style>   
            .td-nivel-5 {background: #9C9C9C !important;color:black !important;}
.modal-backdrop {
    visibility: hidden !important;
}
.modal.in {
    background-color: rgba(0,0,0,0.5);
}
            
        </style> 
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php echo $this->element('header'); ?><!--CABECERA PRINCIPAL-->
            <?php echo $this->element('toolbar'); ?><!--MENU PRINCIPAL-->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1 class="hidden-xs"><i class="fa fa-user"></i> Pedidos Clientes</h1>
                    <ol class="breadcrumb">
                        <li><a href="/chaco/"><i class="fa fa-home"></i> Inicio</a></li>
                        <li class="active">Pedidos Clientes</li>                    
                    </ol>                  
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="box-tools">
                                        <a onclick="add()" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#mymodal">
                                            <i class="fa fa-plus"> AGREGAR</i>
                                        </a>
                                    </div>
                                </div>                                
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <?php if (!empty($_SESSION['mensaje'])) { ?>                             
                                                <div class="alert alert-danger" role="alert" id="mensaje">
                                                    <i class="ion ion-information-circled"></i>
                                                    <?php
                                                    echo $_SESSION['mensaje'];
                                                    $_SESSION['mensaje'] = '';
                                                    ?>
                                                </div>
                                            <?php } ?>                                            
                                            <form action="articulo_index.php" method="post" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar"
                                                                       placeholder="Ingrese valor a buscar..." autofocus>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-primary btn-flat" 
                                                                            data-title="Click para buscar" data-placement="bottom" rel="tooltip">
                                                                        <i class="fa fa-search"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>                                            
                                            <?php
                                            //consulta datos de la tabla articulo
                                            //consulta datos de la tabla marca
                                            if (!empty($consultas)) { ?>
                                                    <table class=" table table-bordered table-striped dt-responsive tablas" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Cliente</th>
                                                                            <th>Sucursal</th>
                                                                            <th>Total</th>
                                                                            <th>Estado</th>
                                                                            <th class="text-center">Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                <?php foreach ($consultas as $consulta) { ?>
                                                                            <tr>
                                                                                <td data-title="Fecha"><?php echo date("d/m/Y", strtotime($consulta[0]['ped_fecha'])); ?></td>
                                                                                <td data-title="Cliente:"><?php echo "(".$consulta[0]['cli_ci_ruc'].") ".$consulta[0]['cliente']; ?></td>
                                                                                <td data-title="Sucursal"><?php echo $consulta[0]['suc_nombre']; ?></td>                                                                                
                                                                                <td data-title="Total"><?php echo number_format($consulta[0]['ped_total'], 0, ",","."); ?></td>
                                                                                <td data-title="Sucursal"><?php echo $consulta[0]['ped_estado']; ?></td>
                                                                                <td data-title="Acciones" class="text-center">
                                                                                    <a href="/chaco/pedido_ventas/det/<?php echo $consulta[0]['ped_cod']; ?>" class="btn btn-primary btn"
                                                                                       role="button" data-title="Detalles" data-placement="top" 
                                                                                       rel="tooltip"><i class="fa fa-list"></i></a>
                                                                                    <a onclick="anular(<?php echo $consulta[0]['ped_cod']; ?>)" class="btn btn-danger btn"
                                                                                       role="button" data-title="Anular" data-placement="top" 
                                                                                       rel="tooltip"><i class="fa fa-close"></i></a>  
                                                                                    <a onclick="confirmar(<?php echo $consulta[0]['ped_cod']; ?>)" class="btn btn-success btn"
                                                                                       role="button" data-title="Confirmar" data-placement="top" 
                                                                                       rel="tooltip"><i class="fa fa-check"></i></a>                                                                                         
                                                                                </td>
                                                                            </tr>
                                                                <?php } ?>
                                                                    </tbody>
                                                    </table>                                            
                                        <?php } else { //voy a mostrar una alerta ?>
                                                <div class='alert alert-info flat'>
                                                    <span class='glyphicon glyphicon-info-sign'>
                                                    </span> A&uacute;n no se han registrado pedidos
                                                </div>
                                        <?php }; ?>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->                            
                            </div>                                                
                        </div>
                    </div>                 
                </section>                
            </div><!-- /.content-wrapper -->                     
            <div id="mymodal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<div id="mymodalchild" class="modal modal-child" data-backdrop-limit="1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-modal-parent="#mymodal">
    <div class="modal-dialog">
        <div class="modal-content" id="detalles_child">

        </div>
        <!-- /.modal-content --> 
    </div>

</div>            
<?php echo $this->element('footer'); ?><!--ARCHIVOS JS-->

        </div><!-- ./wrapper -->

<?php echo $this->element('js'); ?><!--ARCHIVOS JS-->
        <script>
            function add() {
                $.ajax({
                    type: "GET",
                    url: "/chaco/pedido_ventas/add",
                    cache: false,
                    beforeSend: function () {
                        $('#detalles').html('<img src="/chaco/img/ajax-loader(3).gif">  <strong><i>Cargando...</i></strong>');
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
        <script>
            $("#mensaje").delay(4000).slideUp(200, function () {
                $(this).alert('close');
            });
            
        </script>        
        <div id="IrArriba">
            <div align="left">
                <span id="arriba"><a href='#Ancla'></a></span>
            </div>
        </div>
    </body>
</html>
