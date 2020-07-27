<form action="<?php echo $formulario; ?>" method="post" accept-charset="utf-8" class="form-horizontal" role="form">
    <div class="form-group">
        <!--<label class="col-sm-2 col-lg-2 control-label">Localizar:</label>-->
        <div class="col-sm-12 col-lg-12">
            <div class="input-group custom-search-form">
                <input type="search" class="form-control buscar" name="buscar" placeholder="<?php echo $placeholder;?>"/>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default btn-flat" data-title="Buscar" data-placement="bottom" 
                            rel="tooltip"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div><!-- /input-group -->
        </div>
    </div>
</form>
