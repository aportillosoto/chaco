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
            body, html {
                 background: url(/sigest/img/login-background.jpg) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }            
        </style>
    </head>
    <body>
        <div class="login-box">
            <div class="login-logo" style="background-color:#357ca5;padding:0.3em;color:#fff;">
                <!--<span class="logo-lg" style="/*margin-top: -0.2em;*/"><img src="/sigest/img/logo-mopc-full.png"></span>-->
                <span class="logo-lg" style="margin-top: -0.2em;"><img src="/sigest/img/logo_2019.png" width="70%"></span>
            </div><!-- /.login-logo -->
            <?php echo $this->Session->flash(); ?>                    
                  <div class="login-box-body">
                    <form action="/sigest/users/resetpassword" method="post">
                        <input type="hidden" name="data[User][token]" value="<?php echo $datos[0][0]['access_token'];?>"/>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="Contraseña" name="data[User][password]">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <a href="/sigest/" class="btn btn-default">Cancelar</a>                            
                                <button type="submit" class="btn btn-primary pull-right">Modificar</button>
                            </div> 
                        </div>
                    </form>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box-body -->
        <!-- jQuery 2.1.4 -->
        <script src="/sigest/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="/sigest/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="/sigest/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
