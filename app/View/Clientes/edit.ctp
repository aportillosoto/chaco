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
                        <li class="active">Clientes</li>                    
                    </ol>                  
                </section>
                <!-- Main content -->
                <section class="content-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <i class="ion-android-person-edit"></i>
                                        <h3 class="box-title">Editar Clientes</h3>
                                        <div class="box-tools">                                       
                                            <div class="btn-group" role="group" aria-label="Third group">
                                                <a href="/chaco/clientes" class="btn btn-primary pull-right btn" role="button" data-title="Agregar" data-placement="top" rel="tooltip"><i class="ion-arrow-left-a"></i></a>
                                            </div>                                                                                                                                                                
                                        </div>
                                    </div>                                
                                    <form id="form_cliente" action="chaco/clientes/edit" method="post" accept-charset="utf-8" class="form-horizontal" role="form">
                                        <input type="hidden" class="form-control" name="data[Cliente][id]" value="<?php echo $clientes[0][0]['id_cliente']?>"/>
                                        <div class="box-body">  
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Tipo Cliente: </label>
                                                <div class="col-md-3 col-sm-5 col-lg-3">                    
                                                    <select class="form-control select2" name="data[Cliente][tipo]" required="" onchange="tipocli()" id="tipo">
                                                        <?php
                                                        foreach ($tipos as $t): ?>
                                                            <option value="<?php echo $t[0]['tipo_cliente']; ?>"><?php echo$t[0]['tipo_cliente']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>                       
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">CI/RUC:</label>
                                                <div class="col-md-4 col-sm-4 col-lg-3">
                                                    <input type="text" class="form-control" name="data[Cliente][ci]" placeholder="Ingrese el RUC o CI del cliente" required="" value="<?php echo $clientes[0][0]['cli_ci_ruc']?>"/>
                                                </div>
                                            </div>  
                                            
                                            <div class="form-group fisica">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Nombres:</label>
                                                <div class="col-md-6 col-sm-9 col-lg-7">
                                                    <input type="text" class="form-control" id="nombres" name="data[Cliente][nombres]" placeholder="Ingrese el nombre del cliente" value="<?php echo $clientes[0][0]['cli_nombre']?>" required=""/>
                                                </div>
                                            </div>      
                                            <div class="form-group fisica">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Apellidos:</label>
                                                <div class="col-md-6 col-sm-9 col-lg-7">
                                                    <input type="text" class="form-control" id="apellidos" name="data[Cliente][apellidos]" placeholder="Ingrese el apellido del cliente" value="<?php echo $clientes[0][0]['cli_apelli']?>" required=""/>
                                                </div>
                                            </div>                                                                                             
                                            <div class="form-group juridica">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Raz&oacute;n Social:</label>
                                                <div class="col-md-6 col-sm-9 col-lg-7">
                                                    <input type="text" class="form-control" id="razon" name="data[Cliente][razon]" placeholder="Ingrese el nombre de la empresa" value="<?php echo $clientes[0][0]['cli_nombre']?>" required=""/>
                                                </div>
                                            </div>                                              
                                            <div class="form-group has-feedback fisica">
                                              <label class="col-md-3 col-sm-3 col-lg-3 control-label">Fecha Nacimiento:</label>
                                              <div class="col-md-4 col-sm-5 col-lg-2">
                                                  <input type="date" class="form-control" name="data[Cliente][fecnac]" value="<?php echo $tipos[0][0]['fecha'];?>"/>
                                                  <i class="ion-android-calendar form-control-feedback"></i>
                                              </div>
                                            </div> 
                                            <div class="form-group fisica">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Genero: </label>
                                                <div class="col-md-3 col-sm-5 col-lg-2">                    
                                                    <select class="form-control select2" name="data[Cliente][genero]">
                                                        <option value="">Seleccione un genero</option>
                                                        <?php foreach ($genero as $g): ?>
                                                            <option value="<?php echo $g[0]['sexo']; ?>"><?php echo $g[0]['sexo']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>                                             
                                            <div class="form-group has-feedback">
                                              <label class="col-md-3 col-sm-3 col-lg-3 control-label">Correo:</label>
                                              <div class="col-md-4 col-sm-5 col-lg-4">
                                                  <input type="email" class="form-control" name="data[Cliente][correo]" placeholder="Ingrese el correo del cliente"/>
                                                  <i class="form-control-feedback">@</i>
                                              </div>
                                            </div>  
                                            <div class="form-group has-feedback">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Tel&eacute;fono:</label>
                                              <div class="col-md-4 col-sm-5 col-lg-4">
                                                  <input type="text" class="form-control" name="data[Cliente][telefono]" placeholder="Ingrese un número de contacto"/>
                                                  <i class="ion-ios-telephone form-control-feedback"></i>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Lugar Residencia: </label>
                                                <div class="col-md-3 col-sm-5 col-lg-3">                    
                                                    <select class="form-control select2" name="data[Cliente][residencia]" id="ciudad">
                                                        <option value="">Seleccione una ciudad</option>
                                                        <?php foreach ($ciudades as $c): ?>
                                                            <option value="<?php echo $c[0]['id_ciud']; ?>"><?php echo $c[0]['nombre_ciud']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Direcci&oacute;n:</label>
                                              <div class="col-md-4 col-sm-5 col-lg-4">
                                                  <textarea class="form-control"  name="data[Cliente][direccion]" placeholder="Ingrese una dirección" rows="2"></textarea>                                                  
                                              </div>
                                            </div>                                            
                                            <div class="form-group fisica">
                                                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Nacionalidad: </label>
                                                <div class="col-md-3 col-sm-5 col-lg-3">                    
                                                    <select class="form-control select2" name="data[Cliente][nacionalidad]" id="pais">
                                                        <option value="0">Seleccione una nacionalidad</option>
                                                        <?php foreach ($paises as $p): ?>
                                                            <option value="<?php echo $p[0]['id_pais']; ?>"><?php echo $p[0]['gentilicio']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>                                                
                                        </div>       
                                        <div class="box-footer">
                                            
                                            <a href="/chaco/clientes" type="button" class="btn btn-default">
                                                <span class="glyphicon glyphicon-remove"></span><span class="hidden-xs"> Volver</span>
                                            </a>
                                            <button type="submit" class="btn btn-warning pull-right">
                                                <i class="fa fa-edit"></i> Actualizar</button>
                                        </div>   
                                    </form>                        
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

        <?php echo $this->element('js'); ?><!--ARCHIVOS JS-->
        <script>            
            $('#ciudad').val(<?php echo $clientes[0][0]['lugar_resid']?>).trigger('change.select2');            
            tipocli();
        function tipocli(){            
                if ($("#tipo").val()==="FISICA") {
                   $(".fisica").show();
                    $(".juridica").hide();
                    $('#nombres').prop("required", true);
                    $('#apellidos').prop("required", true);
                    $('#razon').prop("required", false);
                }else{
                    $(".fisica").hide();
                    $(".juridica").show();
                    $('#nombres').prop("required", false);
                    $('#apellidos').prop("required", false);
                    $('#razon').prop("required", true);
                }
        };            
            function editar(datos) {
                var dat = datos.split("_");
                $('#idca').val(dat[0]);
                $('#nombreca').val(dat[1]);
            }

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', '/chaco/clientes/delete/' + dat[0] + '/' + dat[1]);
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea borrar la caja <i><strong>' + dat[1] + '</strong></i>?');

            }
        </script>
        <script>
            $('.modal').on('shown.bs.modal', function () {
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
