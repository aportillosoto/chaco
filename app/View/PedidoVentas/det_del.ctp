<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title custom_align" id="Heading"><i class="fa fa-trash"></i><strong> Borrar Item</strong></h4>
</div>

    <form id="form_del_det"  method="post" accept-charset="utf-8" class="form-horizontal" role="form">
        <input type="hidden" class="form-control" name="data[PedidoVenta][pedido]" value="<?php echo $pedido_detalle[0][0]['ped_cod']?>"/>
        <input type="hidden" class="form-control" name="data[PedidoVenta][articulo]" value="<?php echo $pedido_detalle[0][0]['art_cod']?>"/>
       <div class="modal-body">            
            <div class="alert alert-danger">
                <p><span class="glyphicon glyphicon-warning-sign">                        
                </span> Desea quitar el item <strong><?php echo $pedido_detalle[0][0]['art_descri'];?></strong> del pedido ? </p>           
            </div>               
        </div>       
        <div class="modal-footer">
            <button type="reset" data-dismiss="modal" class="btn btn-default">
                <i class="fa fa-close"></i> Cerrar</button>
            <button type="submit" class="btn btn-danger pull-right">
                <i class="fa fa-trash"></i> Borrar</button>
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
        $("#form_del_det").submit(function (event) {
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
                url: "/chaco/pedido_ventas/det_del",
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