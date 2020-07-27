<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title custom_align" id="Heading"><i class="fa fa-list"></i><strong> Datos Facturación</strong></h4>
</div>
<form id="form_fin" action="/sigest/pre_cobros/confirmar" method="post" accept-charset="utf-8" class="form-horizontal" role="form">
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
        <div class="form-group required">
            <label class="col-md-2 col-sm-3 col-lg-3 control-label">Formas de Pago: </label>
            <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12">
                <select class="form-control select2" name="data[PreCobro][forma]" required style="width: 100%">     
                        <option value="BOCA">BOCA DE COBRANZAS</option>
                        <option value="VPOS">POS ONLINE. Pago online</option>
                        <option value="ZIMPLE">BILLETERA ZIMPLE</option>
                </select>
            </div>
        </div>         
    </div>       
    <div class="modal-footer">
        <button type="reset" data-dismiss="modal" class="btn btn-danger">
            <i class="fa fa-close"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary pull-right">
            <i class="fa fa-floppy-o"></i> Confirmar</button>
    </div>   
</form>

<script>
    $(function() {
        $("[rel='tooltip']").tooltip();
    });
    $(".select2").select2();  

</script>
