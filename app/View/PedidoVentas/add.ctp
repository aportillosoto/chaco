<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title custom_align" id="Heading"><i class="fa fa-list"></i><strong> Agregar Pedido Clientes</strong></h4>
</div>

    <form id="form_pedido" action="/chaco/pedido_ventas/add" method="post" accept-charset="utf-8" class="form-horizontal" role="form">
        <div class="modal-body">            
            <div class="form-group has-feedback">
                <label class="col-md-3 control-label">Fecha:</label>
                <div class="col-md-4 col-sm-4 col-lg-4">
                    <input type="text" class="form-control" name="data[PedidoVenta][fecha]" value="<?php echo date("d/m/Y", strtotime($clientes[0][0]['fecha']));?>" readonly=""/>
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 col-lg-3 control-label">Cliente: </label>
                <div class="col-md-9 col-sm-9 col-lg-9">
                    <div class="input-group" id="div_clientes">
                    <select class="form-control select2" name="data[PedidoVenta][cliente]" required="" style="width: 100%">
                        <option value="">Seleccione un cliente</option>
                        <?php foreach ($clientes as $c): ?>
                            <option value="<?php echo $c[0]['id_cliente']; ?>"><?php echo "(".$c[0]['cli_ci_ruc'].")" ." ". $c[0]['nombres']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <span class="input-group-btn">
                        <a href="/chaco/pedido_ventas/add_cli" class="btn btn-primary" data-target="#mymodalchild" data-toggle="modal"
                                type="button" data-title="Agregar Cliente" data-placement="top" rel="tooltip">
                            <i class="fa fa-plus"></i>
                        </a>
                    </span>                         
                    </div>
                </div>
            </div>         
            <div class="form-group">
              <label class="col-md-3 col-sm-3 col-lg-3 control-label">Observaciones: </label>
              <div class="col-md-9 col-sm-9 col-lg-9">
                  <textarea class="form-control"  name="data[PedidoVenta][obs]" rows="2" required=""></textarea>
              </div>
            </div>             
        </div>       
        <div class="modal-footer">
            <button type="reset" data-dismiss="modal" class="btn btn-danger">
                <i class="fa fa-close"></i> Cerrar</button>
            <button type="submit" class="btn btn-primary pull-right">
                <i class="fa fa-floppy-o"></i> Registrar</button>
        </div>   
    </form>


<script>
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
    $(".select2").select2();

</script>
<script>
    function cerrar() {
        $("#mymodalchild").modal("hide");
    }
</script>  
<script>
/*$('.modal-child').on('show.bs.modal', function () {
    var modalParent = $(this).attr('data-modal-parent');
    $(modalParent).css('opacity', 0);
});
 
$('.modal-child').on('hidden.bs.modal', function () {
    var modalParent = $(this).attr('data-modal-parent');
    $(modalParent).css('opacity', 1);
});    */
</script>