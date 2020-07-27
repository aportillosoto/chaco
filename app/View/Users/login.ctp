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
            body, html {
                 background: url(/chaco/img/login-background.jpg) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }            
        </style>
    </head>
    <body>
        <div class="login-box">
            <div class="login-logo" style="background-color:#7e94a245;padding:0.3em;color:#fff;">
                <!--<span class="logo-lg" style="/*margin-top: -0.2em;*/"><img src="/chaco/img/logo-mopc-full.png"></span>-->
                <span class="logo-lg" style="margin-top: -0.2em;"><img src="/chaco/img/logo_chaco.png" width="40%"></span>
            </div><!-- /.login-logo -->
            <?php echo $this->Session->flash(); ?>
            <div class="login-box-body">
                <form action="/chaco/users/login" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Usuario" name="data[User][username]" autofocus="">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Contraseña" name="data[User][password]">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <button type="submit" class="btn btn-primary pull-right">Acceder</button>
                        </div> 
                    </div>
                </form>
                <a href="/chaco/users/forgotpassword">Olvid&eacute; mi contrase&ntilde;a</a>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="/chaco/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="/chaco/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="/chaco/plugins/iCheck/icheck.min.js"></script>
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
