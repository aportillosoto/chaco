
<?php if (!empty($cuentas)) { ?>  
    <div class="box box-warning">

        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">Cuentas Pendientes</h3>            
        </div>

        <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive" id="datoscuentas" width="100%">

                <thead>

                    <tr>
                        <th class="text-center">Concepto</th>
                        <th class="hidden-xs text-center">Vencimiento</th>
                        <th class="text-center text-center">A pagar</th>
                        <th class="hidden-xs text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cuentas as $cuenta): ?>
                        <tr>
                            <td data-title="Concepto" class="hidden-xs"><?php echo $cuenta[0]['descri_cta']; ?></td>
                            <td data-title="Concepto" class="hidden-lg hidden-sm hidden-sm"><?php echo $cuenta[0]['descri_cta']."<br> Venc.".date("d/m/Y", strtotime($cuenta[0]['fec_venc']));?></td>                            
                            <td data-title="Vencimiento" class="hidden-xs"><?php echo date("d/m/Y", strtotime($cuenta[0]['fec_venc'])); ?></td>
                            <td data-title="A pagar" class="text-center"><?php echo number_format($cuenta[0]['cta_saldo'], 0, ",", "."); ?></td>
                            <td data-title="Acciones" class="text-center">
                                <div class="btn-group">                                   
                                    <?php if($cuenta[0]['fec_venc']===$ctaant[0][0]['venc_min'] || empty($ctaant[0][0]['venc_min'])){?> 
                                    <a onclick="add()" id="<?php echo $cuenta[0]['nro_cta']; ?>" class="btn btn-xs btn-xs btn-primary cuenta" role="button" data-title="Agregar" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#mymodal"><span class="fa fa-plus"></span></a>
                                    <?php }?> 
                                </div>
                            </td>
                        </tr>								
                <?php endforeach; ?>                        
                </tbody>    
            </table>            
        </div>
        <div class="box-footer">
            <a href="/sigest/pre_cobros" type="button" class="btn btn-default pull-left" id="btn-listar">CANCELAR</a>            
        </div>        
    </div>
<?php } else { ?>
    <div class="alert alert-info flat">
        <span class="glyphicon glyphicon-info-sign"></span>
        No se encontraron cuentas pendientes...
    </div>
<?php } ?>         
  
<script>   
    $("document").ready(function(){
     
        var $form = $(this);
       // Let's select and cache all the fields
       var $inputs = $form.find("input, select, button, textarea");
       $form.find("div [id='datoscuentas'] input:visible:first").focus();
       $form.find("div [id='datoscuentas'] input:visible:first").select();
       // Serialize the data in the form
       
       //$inputs.prop("disabled", true);        
    });       
 function add() {
        $.ajax({
                    type: "GET",
                    url: "/sigest/pre_cobros/add/"+$(".cuenta").attr('id'),
                    cache: false,
                    beforeSend: function() {
                        //$('#detalles').html('<img src="/sigest/img/ajax-loader(3).gif">  <strong><i>Cargando...</i></strong>');
                        $("#detalles").html('<div class="loader"><div class="loader_ajax_small"></div></div>');
                    },
                    success: function(msg) {
                        $('#detalles').html(msg);
                    }
                });
            }    
</script>