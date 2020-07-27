<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title custom_align" id="Heading"><i class="fa fa-edit"></i><strong> Editar Item</strong></h4>
</div>

    <form id="form_edit_det"  method="post" accept-charset="utf-8" class="form-horizontal" role="form">
        <input type="hidden" class="form-control" name="data[PedidoVenta][pedido]" value="<?php echo $pedido_detalle[0][0]['ped_cod']?>"/>
        <input type="hidden" class="form-control" name="data[PedidoVenta][articulo]" value="<?php echo $pedido_detalle[0][0]['art_cod']?>"/>
       <div class="modal-body">            
        <div class="form-group">
            <label class="col-md-3 control-label">Descripción:</label>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <input type="text" class="form-control" name="data[PedidoVenta][descricion]" value="<?php echo $pedido_detalle[0][0]['art_descri']?>" readonly=""/>
            </div>
        </div>        
        <div class="form-group">
            <label class="col-md-3 control-label">Cantidad:</label>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <input type="number" class="form-control" name="data[PedidoVenta][cantidad]" value="<?php echo $pedido_detalle[0][0]['ped_cant']?>" min="1" required=""/>
            </div>
        </div>  
        <div class="form-group">
            <label class="col-md-3 control-label">Precio:</label>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <input type="text" class="form-control" name="data[PedidoVenta][precio]" value="<?php echo number_format($pedido_detalle[0][0]['ped_precio'], 0, ",",".")?>" min="1" required="" onkeyup="format(this)" onchange="format(this)"/>
            </div>
        </div>             
        </div>       
        <div class="modal-footer">
            <button type="reset" data-dismiss="modal" class="btn btn-default">
                <i class="fa fa-close"></i> Cerrar</button>
            <button type="submit" class="btn btn-warning pull-right">
                <i class="fa fa-edit"></i> Actualizar</button>
        </div>   
    </form>


<script>
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
    $(".select2").select2();

</script>
<script>
    $(function () {
// Variable to hold request
        var request;

// Bind to the submit event of our form
        $("#form_edit_det").submit(function (event) {
            // Prevent default posting of form - put here to work in case of errors
            event.preventDefault();
            // Abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this);
            // Let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");

            // Serialize the data in the form
            var serializedData = $form.serialize();
            $inputs.prop("disabled", true);

            // Fire off the request to /form.php
            request = $.ajax({
                url: "/chaco/pedido_ventas/det_edit",
                type: "post",
                data: serializedData
            });

            // Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR) {
                // Log a message to the console
                cerrar();
                $("#detalles").html(response);
            });

            // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown) {
                // Log the error to the console  
                cerrar();
            });
        });
    });
</script>