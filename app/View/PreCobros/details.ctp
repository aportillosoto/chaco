<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="box box-success">    
            <div class="box-header">
                <i class="fa fa-list"></i>
                <h3 class="box-title">Detalles</h3>                
            </div><!-- /.box-header -->        
                <div class="box-body">
<?php if(!empty($detalles)){?>          
                    <input type="hidden" value="<?php echo $detalles[0][0]['nro_pcobro'];?>" id="_nro">
                    <table class="table table-bordered table-striped dt-responsive" width="100%">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th class="text-center">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($detalles as $det): ?>
                            <tr id="<?php echo $det[0]['nro_cta']; ?>">                        
                                    <td data-title="Descripción"><?php echo $det[0]['obs'];?></td>
                                    <td data-title="Monto" class="text-center"><?php echo number_format($det[0]['cob_monto'],0,",","."); ?></td>
                            </tr>								
                        <?php endforeach; ?>
                        </tbody>					
                    </table>
                                    <?php }else { ?>
                                        <div class="alert alert-info flat">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            Aún no agrego ningún detalle...
                                        </div>
                                    <?php } ?>                    
                </div><!-- /.box-body -->
        </div>

    </div>
</div>
<script>
    $('.toggle').bootstrapToggle();

</script>