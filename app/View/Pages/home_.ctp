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
        <style >
            
            
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php echo $this->element('header'); ?><!--CABECERA PRINCIPAL-->
            <?php echo $this->element('toolbar'); ?><!--MENU PRINCIPAL-->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Bienvenido al Sistema de Gestión Alumno
                        <small>Version 1.0</small>                        
                    </h1>
                    </section>                    
                    <section class="content">
                    <div class="row">
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-aqua"><i class="ion ion-social-usd"></i></span>

                          <div class="info-box-content">
                            <span class="info-box-text">Estado Cuenta</span>
                            <small>Matriculas, cuotas ...</small>
                          </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                      </div>
                      <!-- /.col -->
                   </div>
                </section>
            </div><!-- /.content-wrapper -->

        <?php echo $this->element('footer'); ?><!--ARCHIVOS JS-->

        </div><!-- ./wrapper -->

        <?php echo $this->element('js'); ?><!--ARCHIVOS JS-->
    </body>
</html>