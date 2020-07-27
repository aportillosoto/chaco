<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/sigest/favicon.ico">
        <title>Siecorp</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php echo $this->element('css'); ?><!--ARCHIVOS CSS-->

        <style>
            .login-box, .register-box {
                width: 360px;
                margin: 5% auto;
            }
        </style>

    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <a href="/sicoe" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <!--<span class="logo-mini"><b>S</b>ICOE</span>-->
                <!-- logo for regular state and mobile devices -->
                <!--<span class="logo-lg" style="/*margin-top: -0.2em;*/"><img src="/sigest/img/logo-mopc-full.png"></span>-->
                <h3>Logo del salon</h3>
            </a>
            <br>
            <br>

            <div class="register-box-body">
                <p class="login-box-msg">Registrar un nuevo usuario</p>
                <form action="/test/users/add" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Nombre de usuario" name="data[User][username]">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Contraseña" name="data[User][password]">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
<!--                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">-->
                            <div class="checkbox icheck">
                                <label>
                                    <input type="hidden" value="false" name="data[User][usu_admin]">
                                    <input type="checkbox" value="true" name="data[User][usu_admin]"> Usuario administrador
                                </label>
                            </div>
<!--                        </div>-->
                    </div>
                    <div class="row">    
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                        </div><!-- /.col -->
                    </div>
                </form>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->

        <?php echo $this->element('js'); ?><!--ARCHIVOS JS-->
    </body>
</html>
