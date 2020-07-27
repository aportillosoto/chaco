<div class="modal-header">
    <button onclick="cerrar()" type="button" class="close" aria-hidden="true">×</button>
    <h4 class="modal-title custom_align" id="Heading"><i class="fa fa-plus"></i><strong> Agregar Cliente</strong></h4>
</div>   
<form id="form_cliente" action="/chaco/cleintes/add" method="post" accept-charset="utf-8" class="form-horizontal" role="form">
    <div class="modal-body">  
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-lg-3 control-label">Tipo Cliente: </label>
            <div class="col-md-9 col-sm-9 col-lg-9">                    
                <select class="form-control select2" name="data[PedidoVenta][tipo]" required="" style="width: 100%">
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($tipos as $t): ?>
                        <option value="<?php echo $t[0]['tipo_cliente']; ?>"><?php echo$t[0]['tipo_cliente']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>                       
        <div class="form-group">
            <label class="col-md-3 control-label">CI/RUC:</label>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <input type="text" class="form-control" name="data[PedidoVenta][ci]"/>
            </div>
        </div>  
        <div class="form-group">
            <label class="col-md-3 control-label">Nombres:</label>
            <div class="col-md-6 col-sm-6 col-lg-9">
                <input type="text" class="form-control" name="data[PedidoVenta][nombres]"/>
            </div>
        </div>      
        <div class="form-group">
            <label class="col-md-3 control-label">Apellidos:</label>
            <div class="col-md-6 col-sm-6 col-lg-9">
                <input type="text" class="form-control" name="data[PedidoVenta][apellidos]"/>
            </div>
        </div>   
        <div class="form-group">
            <label class="col-md-3 control-label">Telefono:</label>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <input type="text" class="form-control" name="data[PedidoVenta][telefono]"/>
            </div>
        </div>                       
    </div>       


    <div class="modal-footer">
        <button onclick="cerrar()" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-remove"></span><span class="hidden-xs"> Cerrar</span>
        </button>
        <button type="submit" class="btn btn-primary pull-right">
            <i class="fa fa-floppy-o"></i> Guardar</button>
    </div>   
</form>
<script>
    $(function () {
// Variable to hold request
        var request;

// Bind to the submit event of our form
        $("#form_cliente").submit(function (event) {
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
                url: "/chaco/pedido_ventas/add_cli",
                type: "post",
                data: serializedData
            });

            // Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR) {
                // Log a message to the console
                cerrar();
                $("#div_clientes").html(response);
            });

            // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                cerrar();
            });

            // Callback handler that will be called regardless
            // if the request failed or succeeded
            /*   request.always(function () {
             // Reenable the inputs
             $inputs.prop("disabled", false);
             view(nro);
             });*/

        });
    });
</script>
 