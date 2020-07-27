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
         
        </style> 
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php echo $this->element('header'); ?><!--CABECERA PRINCIPAL-->
            <?php echo $this->element('toolbar'); ?><!--MENU PRINCIPAL-->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1 class="hidden-xs"><i class="fa fa-user"></i> Detalle Pedido Cliente</h1>
                    <ol class="breadcrumb">
                        <li><a href="/chaco/"><i class="fa fa-home"></i> Inicio</a></li>
                        <li class="active">Detalle de Pedido</li>                    
                    </ol>                  
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <input type="hidden" id="ancla_seleccionado">
                        <div class="row">
                            <div class="box box-primary"> 
                                <div class="box-header">
                                    <div class="box-tools">
                                        <a href="/chaco/pedido_ventas" class="btn btn-default pull-right btn-sm">
                                            <i class="fa fa-arrow-left"> VOLVER</i>
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
                                            <?php if (!empty($consultas)) { ?>
                                            <table class="table table-bordered table-striped dt-responsive" id="pedidos" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Fecha</th>
                                                                            <th>Cliente</th>
                                                                            <th>Sucursal</th>
                                                                            <th>Total</th>
                                                                            <th>Estado</th>                                                                            
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
                                                                            </tr>
                                                                <?php } ?>
                                                                    </tbody>
                                                    </table>                                            
                                        <?php } else { //voy a mostrar una alerta ?>
                                            <script>
                                            window.location.replace("/chaco/pedido_ventas");
                                            </script>
                                        <?php }; ?>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->                               
                            </div>                                                
                        </div>
                    </div>  
                    <div class="container-fluid">
                        <div class="row">
                            <div class="box box-default">                                                           
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form class="form-inline" action="/chaco/pedido_ventas/det" method="post" id="frm_add_det">
                                                <input type="hidden" name="data[PedidoVenta][pedido]" value="<?php echo $consultas[0][0]['ped_cod']; ?>"/>
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Articulo: </label>
                                                <div class="col-md-9 col-sm-9 col-lg-9">
                                                    <select class="form-control select2" name="data[PedidoVenta][articulo]" required="" id="arti" onchange="precio()" onclick="precio()">
                                                        <option value="">Seleccione un articulo</option>
                                                        <?php foreach ($articulos as $a): ?>
                                                            <option value="<?php echo $a[0]['art_cod']."_".$a[0]['art_preciov']; ?>"><?php echo $a[0]['art_descri']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>                                                 
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Cantidad:</label>
                                                <div class="col-md-4 col-sm-4 col-lg-4">
                                                    <input type="number" class="form-control" name="data[PedidoVenta][cantidad]" min="1" value="1"/>
                                                </div>
                                            </div>                                                
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Precio:</label>
                                                <div class="col-md-4 col-sm-4 col-lg-4">
                                                    <input type="text" class="form-control" name="data[PedidoVenta][precio]" id="prec" onkeyup="format(this)" onchange="format(this)"/>
                                                </div>
                                            </div>
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-plus"></i></button>
                                           </form>                                             
                                        </div>                                        
                                    </div>                                    
                                </div>
                            </div>                                                
                        </div>
                    </div>    
                    <div class="container-fluid" id="detalles">
                        <div class="row">
                            <div class="box box-primary">                                                
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">                                                                               
                                            <?php if (!empty($detalles)) { ?>
                                            <table class="table table-bordered table-striped dt-responsive" id="det_item" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Item</th>
                                                                            <th>Cantidad</th>
                                                                            <th>Precio</th>
                                                                            <th>Subtotal</th>
                                                                            <th>Impuesto</th>       
                                                                            <th class="text-center">Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                <?php foreach ($detalles as $d) { ?>
                                                                            <tr>
                                                                                <td data-title="Item:"><?php echo $d[0]['art_descri']; ?></td>
                                                                                <td data-title="Cantidad:"><?php echo $d[0]['ped_cant']; ?></td>                                                                                
                                                                                <td data-title="Precio"><?php echo number_format($d[0]['ped_precio'], 0, ",","."); ?></td>
                                                                                <td data-title="Subtotal"><?php echo number_format($d[0]['subtotal'], 0, ",","."); ?></td>
                                                                                <td data-title="Impuesto"><?php echo $d[0]['tipo_descri']; ?></td>
                                                                                <td data-title="Acciones" class="text-center">
                                                                                    <a onclick="editar(<?php echo $d[0]['ped_cod']; ?>,<?php echo $d[0]['art_cod']; ?>)" class="btn btn-warning btn"
                                                                                       role="button" data-title="Editar" data-placement="top" 
                                                                                       rel="tooltip" data-toggle="modal" data-target="#mymodal"><i class="fa fa-edit"></i></a>
                                                                                    <a onclick="quitar(<?php echo $d[0]['ped_cod']; ?>,<?php echo $d[0]['art_cod']; ?>)" class="btn btn-danger btn"
                                                                                       role="button" data-title="Quitar" data-placement="top" 
                                                                                       rel="tooltip" data-toggle="modal" data-target="#mymodal"><i class="fa fa-trash"></i></a>                                                                                          
                                                                                </td>                                                                                
                                                                            </tr>
                                                                <?php } ?>
                                                                    </tbody>
                                                    </table>                                            
                                        <?php } else { //voy a mostrar una alerta ?>
                                                <div class='alert alert-info flat'>
                                                    <span class='glyphicon glyphicon-info-sign'>
                                                    </span> A&uacute;n no se han registrado detalles al pedido
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
                    <div class="modal-content" id="valores">

                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>            
<?php echo $this->element('footer'); ?><!--ARCHIVOS JS-->

        </div><!-- ./wrapper -->

<?php echo $this->element('js'); ?><!--ARCHIVOS JS-->
        <script>
            $(document).ready(function() {
                $('#pedidos, #det_item').DataTable({                    
                    "paging":   false,
                    "ordering": false,
                    "info":     false,
                     "searching": false
                });
            } );  
            function precio(){              
            //$("#precio").val();  
            var datos = ($("#arti").val()).split('_');              
            $('#prec').val(currency(datos[1],0,'.'));
            
            $("#ancla_seleccionado").val(datos[0]);
            };
        </script>
<script>  
     $('#frm_add_det').bind('submit', function()
        {            
     $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#detalles').html('<div class="rating-flash" id="cargando_div"><strong>Cargando  </strong><img src="/chaco/img/ajax-loader(3).gif"></div>');                    
                },
                success: function(data) {
                    $('#detalles').html(data);
                }
            })
            return false;
        });
            function editar(ped,nro) {
                $("#ancla_seleccionado").val(nro);
                $.ajax({
                    type: "GET",
                    url: "/chaco/pedido_ventas/det_edit/" + ped+"/"+nro,
                    cache: false,
                    beforeSend: function () {
                        $("#valores").html('<div class="loader"><div class="loader_ajax_small"></div></div>');
                    },
                    success: function (msg) {
                        $('#valores').html(msg);
                    }
                });
            };
            function quitar(ped,nro) {
                $.ajax({
                    type: "GET",
                    url: "/chaco/pedido_ventas/det_del/" + ped+"/"+nro,
                    cache: false,
                    beforeSend: function () {
                        $("#valores").html('<div class="loader"><div class="loader_ajax_small"></div></div>');
                    },
                    success: function (msg) {
                        $('#valores').html(msg);
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
<script>
    function cerrar() {
        $("#mymodal").modal("hide");
    }
</script>         
        <div id="IrArriba">
            <div align="left">
                <span id="arriba"><a href='#Ancla'></a></span>
            </div>
        </div>
    </body>
</html>
