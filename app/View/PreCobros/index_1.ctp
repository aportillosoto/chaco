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
        .form-group.required .control-label:after { 
           content:"*";
           color:red;
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
                    <h1 class="hidden-xs">Administrar estado de cuenta</h1>
                    <ol class="breadcrumb">
                        <li><a href="/sigest/"><i class="fa fa-home"></i> Inicio</a></li>
                        <li class="active">Administrar mi estado de cuenta</li>
                    </ol>                  
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12" >
                                <?php echo $this->Session->flash();?>
                                <?php if(empty($consultas)) { ?>                                
                                <div class="box box-primary">
                                    <form  accept-charset="utf-8" class="form-horizontal">
                                        <div class="box-body">
                                            <div class="form-group has-feedback">
                                                <label class="col-md-2 col-sm-3 col-lg-3 control-label">Fecha: </label>
                                                <div class="col-md-3 col-sm-4 col-lg-4">
                                                    <input type="text" class="form-control"  readonly="" value="<?php echo date("d/m/Y", strtotime($sedes[0][0]['fecha'])); ?>">
                                                    <i class="fa fa-calendar form-control-feedback"></i>
                                                </div>
                                            </div>                     
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-3 col-lg-3 control-label">Nombres y Apellidos: </label>
                                                <div class="col-md-8 col-sm-8 col-lg-8">
                                                    <input type="text" class="form-control"  value="<?php echo $datos[0][0]["per_nombre"] . " " . $datos[0][0]["per_apelli"]; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-md-2 col-sm-3 col-lg-3 control-label">Sede: </label>
                                                <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12">
                                                    <select class="form-control select2" name="data[PreCobro][sede]" required id="sede" onchange="carreras()">
                                                        <?php foreach ($sedes as $sed): ?>
                                                            <option value="<?php echo $sed[0]['id_sede']; ?>"><?php echo $sed[0]['sed_nombre']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="form-group required">
                                                <label class="col-md-2 col-sm-3 col-lg-3 control-label">Carrera: </label>
                                                <div class="col-md-8 col-sm-8 col-lg-8" id="div_car">                                                
                                                    <select class="form-control select2">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="col-md-2 col-sm-3 col-lg-3 control-label">Curso: </label>
                                                <div class="col-md-8 col-sm-8 col-lg-8" id="div_cur">
                                                </div>
                                            </div>                                                                          
                                        </div><!-- /.box-body -->                                      
                                    </form>                                                                     
                                        <div class="box-footer">                                                
                                            <button type="button" onclick="cuentas()" class="btn btn-primary pull-right" disabled="disabled"  id="btn-listar">Listar</button>
                                        </div><!-- /.box-footer -->                                      
                                </div><!-- /.box-header -->                                                                    
                                <?php } ?>     
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12" id="cuentas">
                            <div class="alert alert-info"><span class="glyphicon glyphicon-info-sign">                            
                            </span> Favor indique los filtros de b&uacute;squeda para consultar las cuentas, los items marcados
                            con <font size="3" color="red">(*)</font> son obligatorios.
                            <ol><strong><em>Par&aacute;metros de B&uacute;squeda</em></strong>
                            <li>Seleccione la Sede</li>
                            <li>Seleccione la carrera</li>
                            <li>Seleccione el curso</li>
                            </ol>
                            </div>                                
                            </div>
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
            <?php echo $this->element('footer'); ?><!--ARCHIVOS JS-->

        </div><!-- ./wrapper -->

        <?php echo $this->element('js'); ?><!--ARCHIVOS JS-->


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
             $("#btn-listar").prop("disabled", true); 
            carreras();                            
            function carreras() {
                $("#div_cur").html("");
                $("#cuentas").html('<div class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span> Favor indique los filtros de b&uacute;squeda para consultar las cuentas, los items marcados con <font size="3" color="red">(*)</font> son obligatorios.<ol><strong><em>Par&aacute;metros de B&uacute;squeda</em></strong><li>Seleccione la Sede</li><li>Seleccione la carrera</li><li>Seleccione el curso</li></ol></div>');
                $.ajax({
                    type: "GET",
                    url: "/sigest/pre_cobros/carrera/" + $("#sede").val(),
                    beforeSend: function () {
                        $("#div_car").html('<div class="rating-flash"><strong>Obteniendo carreras...</strong><img src="/sigest/img/ajax-loader(2).gif"></div>');
                    },
                    success: function (msg) {
                        $("#div_car").html(msg);
                        cursos();
                    }
                });
            };
            function cursos() {
               $("#cuentas").html('<div class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span> Favor indique los filtros de b&uacute;squeda para consultar las cuentas, los items marcados con <font size="3" color="red">(*)</font> son obligatorios.<ol><strong><em>Par&aacute;metros de B&uacute;squeda</em></strong><li>Seleccione la Sede</li><li>Seleccione la carrera</li><li>Seleccione el curso</li></ol></div>');
                $.ajax({
                    type: "GET",
                    url: "/sigest/pre_cobros/curso/" + $("#carrera").val(),
                    beforeSend: function () {
                        $("#div_cur").html('<div class="rating-flash"><strong>Obteniendo cursos...</strong><img src="/sigest/img/ajax-loader(2).gif"></div>');
                    },
                    success: function (msg) {
                        $("#div_cur").html(msg);
                        $("#btn-listar").prop("disabled", false); 
                        //cuentas();
                    }
                });
            };
            function cuentas() {
                    $.ajax({
                    type: "GET",
                    url: "/sigest/pre_cobros/cuentas/" + $("#carrera").val() + "/" + $("#curso").val(),
                    beforeSend: function () {
                        $("#cuentas").html('<div class="loader"><div class="loader_ajax_small"></div></div>');
                        //$("#cuentas").html('<div class="rating-flash"><strong>Obteniendo cuentas...</strong><img src="/sigest/img/loader.gif"></div>');
                    },
                    success: function (msg) {
                        $("#cuentas").html(msg);
                    }
                });
            };
        </script>
        <div id="IrArriba">
            <div align="left">
                <span id="arriba"><a href='#Ancla'></a></span>
            </div>
        </div>
    </body>
</html>
