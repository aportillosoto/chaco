
    <div class="row">
        <div class="box box-primary">                                                
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">                                                                               
                        <?php if (!empty($detalles)) { ?>
                            <table class="table table-bordered table-striped dt-responsive" id="det_item" width="100%">
                                <thead>
                                    <tr>
                                        <th>Articulo</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
                                        <th>Impuesto</th>       
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detalles as $d) { ?>
                                        <tr id="<?php echo $d[0]['art_cod']; ?>">
                                            <td data-title="Articulo:"><?php echo $d[0]['art_descri']; ?></td>
                                            <td data-title="Cantidad:"><?php echo $d[0]['ped_cant']; ?></td>                                                                                
                                            <td data-title="Precio"><?php echo number_format($d[0]['ped_precio'], 0, ",", "."); ?></td>
                                            <td data-title="Subtotal"><?php echo number_format($d[0]['subtotal'], 0, ",", "."); ?></td>
                                            <td data-title="Impuesto"><?php echo $d[0]['tipo_descri']; ?></td>
                                            <td data-title="Acciones" class="text-center">
                                                <a onclick="editar(<?php echo $d[0]['ped_cod']; ?>,<?php echo $d[0]['art_cod']; ?>)" class="btn btn-warning btn"
                                                   role="button" data-title="Editar" data-placement="top" 
                                                   rel="tooltip" data-toggle="modal" data-target="#mymodal"><i class="fa fa-edit"></i></a>
                                                <a onclick="quitar(<?php echo $d[0]['ped_cod']; ?>,<?php echo $d[0]['art_cod']; ?>)" class="btn btn-danger btn"
                                                   role="button" data-title="Quitar" data-placement="top" 
                                                   rel="tooltip" data-toggle="modal" data-target="#mymodal"><i class="fa fa-trash"></i></a>                                                                                        
                                            </td>                                                                           
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>                                            
                        <?php } else { //voy a mostrar una alerta ?>
                            <div class='alert alert-info flat'>
                                <span class='glyphicon glyphicon-info-sign'>
                                </span> A&uacute;n no se han registrado detalles al pedido
                            </div>
                        <?php }; ?>
                    </div>
                </div>
            </div><!-- /.box-body -->                               
        </div>                                                
    </div>                        

        <script>
            $("document").ready(function () {
                if ("<?php echo $_SESSION['mensaje'] ?>" !== null) {
                    var mensaje = "<?php echo $_SESSION['mensaje'] ?>".split("_");
                    var tipo;
                    var icono;
                    switch (mensaje[1]) {
                        case '1':
                            tipo = 'success';
                            icono = 'glyphicon glyphicon-file';
                            break;
                        case '2':
                            tipo = 'warning';
                            icono = 'glyphicon glyphicon-pencil';
                            break;
                        case '3':
                            tipo = 'danger';
                            icono = 'glyphicon glyphicon-trash';
                            break;
                        default:
                            tipo = 'info';
                            icono = 'glyphicon glyphicon-info-sign';
                    }
                    if (mensaje[0] !== '') {
                        $.notifyDefaults({
                            type: tipo,
                            delay: '3000',
                            allow_dismiss: true
                        });
                        $.notify(
                                {
                                    icon: icono,
                                    message: mensaje[0]
                                }
                        , {
                            animate: {
                                enter: 'animated lightSpeedIn',
                                exit: 'animated lightSpeedOut'
                            }
                        });
                    }
                }

            });
            "<?php $_SESSION['mensaje'] = null; ?>";
        </script> 
        <script>
            $(document).ready(function() {
                if($("#ancla_seleccionado").val().length>0){          
              var valor = $("#ancla_seleccionado").val(); 
              if($("#"+valor).length != 0) {                    
              $("#"+valor+" td").addClass("td-nivel-5")
              var posicion = $("#"+valor).offset().top;
              }else{
              $("."+valor+" td").addClass("td-nivel-5")
              var posicion = $("."+valor).offset().top;          
              }
                $("html, body").animate({
                    scrollTop: posicion
                }, 1000);                  

                  $("#ancla_seleccionado").val('');                                                          
                };   
            } );  
        
        </script> 
        <script>
            $(document).ready(function() {
                $('#det_item').DataTable({
                    "paging":   false,
                    "ordering": false,
                    "info":     false,
                     "searching": false
                });
            } );  
          
        </script>         
        