<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title custom_align" id="Heading"><i class="fa fa-check"></i><strong> Realizar Pago</strong></h4>
</div>
<form id="form_fin" action="/sigest/pre_cobros/pay" method="post" accept-charset="utf-8" class="form-horizontal" role="form">
    <input type="hidden" name="data[PreCobro][nro]" value="<?php echo $consultas[0][0]['nro_pcobro']; ?>"/>
    <div class="modal-body">
        <div class="form-group required">
            <label class="col-md-2 col-sm-3 col-lg-3 control-label">C.I / R.U.C: </label>
            <div class="col-md-8 col-sm-8 col-lg-8">
                <input type="text" class="form-control" name="data[PreCobro][ruc]" value="<?php echo $consultas[0][0]["ruc_de"]; ?>" required="">
            </div>
        </div>               
        <div class="form-group required">
            <label class="col-md-2 col-sm-3 col-lg-3 control-label">Raz&oacute;n Social: </label>
            <div class="col-md-8 col-sm-8 col-lg-8">
                <input type="text" class="form-control"  name="data[PreCobro][razon]" value="<?php echo $consultas[0][0]["a_nombre_de"]; ?>" required="">
            </div>
        </div>       
    </div>
    <div class="modal-body">
        <div class="alert alert-success">
            <p><span class="glyphicon glyphicon-question-sign">                        
                </span> Desea realizar el pago de la provisi&oacute;n de las cuenta por un total de <strong><?php echo "Gs. " . number_format($consultas[0][0]['total'], 0, ",", "."); ?></strong> ? <br>           
        </div>                    
    </div>
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-default">
            <i class="fa fa-close"></i> Cerrar</button>
        <button type="submit" class="btn btn-success pull-right">
            <i class="fa fa-check"></i> Confirmar</button>
    </div>   
</form>

<script>
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
    $(".select2").select2();

</script>
