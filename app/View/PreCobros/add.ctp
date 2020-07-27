<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title custom_align" id="Heading"><i class="fa fa-list"></i><strong> Agregar cuenta</strong></h4>
</div>
    <form id="form_add" action="/sigest/pre_cobros/add" method="post" accept-charset="utf-8" class="form-horizontal" role="form">
        <input type="hidden" name="data[PreCobro][idsede]" value="<?php echo $cuentas[0][0]['id_sede'];?>"/>
        <input type="hidden" name="data[PreCobro][cuenta]" value="<?php echo $cuentas[0][0]['nro_cta'];?>"/>
        <input type="hidden" name="data[PreCobro][monto]" value="<?php echo $cuentas[0][0]['cta_saldo'];?>"/>
        <div class="modal-body">
            <div class="alert alert-success">
                <p><span class="glyphicon glyphicon-warning-sign">                        
                </span> Desea agregar la cuenta <strong><?php echo $cuentas[0][0]['descri_cta'];?></strong> con vencimiento el 
                <strong><?php echo date("d/m/Y", strtotime($cuentas[0][0]['fec_venc']));?></strong> con un monto de <strong><?php echo "Gs. ". number_format($cuentas[0][0]['cta_saldo'],0, ",",".");?></strong> ? <br>
                A continuación se creará una provisión para pago donde podrá realizar otras operaciones.</p>                
            </div>                  
        </div>       
        <div class="modal-footer">
            <button type="reset" data-dismiss="modal" class="btn btn-danger">
                <i class="fa fa-close"></i> Cerrar</button>
            <button type="submit" class="btn btn-primary pull-right">
                <i class="fa fa-floppy-o"></i> Confirmar</button>
        </div>   
    </form>
