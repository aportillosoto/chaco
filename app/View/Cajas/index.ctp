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

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php echo $this->element('header'); ?><!--CABECERA PRINCIPAL-->
            <?php echo $this->element('toolbar'); ?><!--MENU PRINCIPAL-->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <ol class="breadcrumb">
                        <li><a href="/chaco/"><i class="fa fa-home"></i> Inicio</a></li>
                        <li class="active">Cajas</li>                    
                    </ol>                  
                </section>
                <!-- Main content -->
                <section class="content-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Cajas</h3>
                                    <div class="box-tools">
                                        <div class="btn-group" role="group" aria-label="Third group">
                                            <a href="/chaco/cajas/print" class="btn btn-default pull-right btn" target="_blank"><i class="fa fa-print"></i></a>
                                        </div>                                        
                                        <div class="btn-group" role="group" aria-label="Third group">
                                          <a href="#" class="btn btn-primary pull-right btn" data-toggle="modal" data-target="#registrar"><i class="fa fa-plus"></i></a>
                                        </div>                                                                                                                                                                
                                    </div>
                                </div>                                
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">                                       
                                            <?php
                                            if (!empty($cajas)) { ?>
                                                    <table class=" table table-bordered table-striped dt-responsive tablas" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Caja</th>
                                                                            <th>Sucursal</th>
                                                                            <th class="text-center">Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                <?php foreach ($cajas as $caja) { ?>
                                                                <tr>
                                                                    <td data-title="Caja"><?php echo $caja[0]['caja_nomb']; ?></td>
                                                                    <td data-title="Sucursal"><?php echo $caja[0]['suc_nombre']; ?></td>
                                                                    <td data-title="Acciones" class="text-center">
                                                                        <a onclick="editar(<?php echo "'" . $caja[0]['id_caja'] . "_" . $caja[0]['caja_nomb']. "_" . $caja[0]['id_sucursal'] . "'"; ?>)" class="btn btn btn-warning" role="button" data-title="Editar" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#editar"><span class="glyphicon glyphicon-pencil"></span></a>
                                                                        <a onclick="borrar(<?php echo "'" . $caja[0]['id_caja'] . "_" . $caja[0]['caja_nomb'] . "'"; ?>)" class="btn btn btn-danger" role="button" data-title="Borrar" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></a>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                    </tbody>
                                                    </table>                                            
                                        <?php } else { //voy a mostrar una alerta ?>
                                                <div class='alert alert-info flat'>
                                                    <span class='glyphicon glyphicon-info-sign'>
                                                    </span> A&uacute;n no se han registrado cajas
                                                </div>
                                        <?php }; ?>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->                            
                            </div>                                 
                            </div>
                                               
                        </div>
                    </div>                 
                </section>                
            </div><!-- /.content-wrapper -->   
            <?php echo $this->element('footer'); ?><!--ARCHIVOS JS-->

        </div><!-- ./wrapper -->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" id="confirmacion"></div>

                    </div>
                    <div class="modal-footer ">
                        <a id="si" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>
                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>

        <div class="modal fade" id="registrar" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Registrar cajas</strong></h4>
                    </div>
                    <form action="/chaco/cajas/add" method="post" accept-charset="utf-8" class="form-horizontal">
                        <input id="txt-id" type="hidden"/>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="caja_nomb" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sucursal:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="suc_nombre" readonly="" value="<?php echo $sucursal[0][0]['suc_nombre']?>">
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="reset" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                            <button type="submit" class="btn btn-success pull-right">Registrar</button>
                        </div><!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editar" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Editar cajas</strong></h4>
                    </div>
                    <form action="/chaco/cajas/edit" method="post" accept-charset="utf-8" class="form-horizontal">
                        <input id="idca" type="hidden" name="id_caja"/>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input id="nombreca" type="text" class="form-control" name="caja_nomb" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sucursal:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="suc_nombre" readonly="" value="<?php echo $sucursal[0][0]['suc_nombre']?>">
                                </div>
                            </div>                            
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="reset" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                            <button type="submit" class="btn btn-warning pull-right">Actualizar</button>
                        </div><!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>

        <?php echo $this->element('js'); ?><!--ARCHIVOS JS-->
        <script>
            function editar(datos) {
                var dat = datos.split("_");
                $('#idca').val(dat[0]);
                $('#nombreca').val(dat[1]);
            }

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', '/chaco/cajas/delete/' + dat[0] + '/' + dat[1]);
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea borrar la caja <i><strong>' + dat[1] + '</strong></i>?');

            }
        </script>
        <script>
            $('.modal').on('shown.bs.modal', function() {
                $(this).find('input:text:visible:first').focus();
            });
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
