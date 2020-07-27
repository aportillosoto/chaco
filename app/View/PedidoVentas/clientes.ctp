<select class="form-control select2" name="data[PedidoVenta][cliente]" required="" style="width: 100%">    
    <?php foreach ($clientes as $c): ?>
        <option value="<?php echo $c[0]['id_cliente']; ?>"><?php echo "(" . $c[0]['cli_ci_ruc'] . ")" . " " . $c[0]['nombres']; ?></option>
    <?php endforeach; ?>
</select>
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