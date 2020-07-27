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
                        Bienvenido al Sistema Chaco Service
                        <small>Version 1.0</small>                        
                    </h1>
                </section>                    
                <section class="content">
                    <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <a href="#" class="small-box-footer hidden-md hidden-lg">
                                Cobros <i class="ion ion-social-usd"></i>
                            </a>
                            <div class="inner">
                                <h3 class="hidden-xs hidden-sm">Cobros</h3>
                                
                                <span class="info-box-text">Fletes, Mudanzas</span>
                            </div>
                            <div class="icon">
                                <i class="ion ion-social-usd"></i>
                            </div>
                            <a href="pre_cobros" class="small-box-footer">
                                Más info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">

                        <div class="small-box bg-green">
                            <a href="#" class="small-box-footer hidden-md hidden-lg">
                                Pedidos <i class="fa fa-list"></i>
                            </a>
                            <div class="inner">

                                <h3 class="hidden-xs hidden-sm">Pedidos</h3>
                                <span class="info-box-text"><small>Pedidos Clientes</small></span>

                            </div>

                            <div class="icon">
                                <i class="fa fa-list"></i>
                            </div>
                            <a href="categorias" class="small-box-footer">
                                Más info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <div class="small-box bg-yellow">
                            <a href="#" class="small-box-footer hidden-md hidden-lg">
                                Perfil <i class="ion ion-person"></i>
                            </a>
                            <div class="inner">

                                <h3 class="hidden-xs hidden-sm">Perfil</h3>
                                <span class="info-box-text"><small>Correo, Teléfono</small></span> 
                            </div>
                            <div class="icon">

                                <i class="ion ion-person"></i>

                            </div>
                            <a href="clientes" class="small-box-footer">

                                Más info <i class="fa fa-arrow-circle-right"></i>
                            </a>

                        </div>

                    </div>

                    <div class="col-lg-3 col-xs-6">

                        <div class="small-box bg-red">
                            <a href="#" class="small-box-footer hidden-md hidden-lg">
                                Mis datos <i class="fa fa-cogs"></i>
                            </a>
                            <div class="inner">

                                <h3 class="hidden-xs hidden-sm">Mis recursos</h3>
                                <span class="info-box-text"><small>Ajustes</small></span>
                            </div>
                            <div class="icon">
                                <i class="fa fa-cogs"></i>
                            </div>
                            <a href="productos" class="small-box-footer">
                                Más info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
</div>                        
                </section>

            </div><!-- /.content-wrapper -->

            <?php echo $this->element('footer'); ?><!--ARCHIVOS JS-->

        </div><!-- ./wrapper -->

        <?php echo $this->element('js'); ?><!--ARCHIVOS JS-->
    </body>
</html>