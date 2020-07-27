<!-- jQuery 2.1.4 -->
<script src="/chaco/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="/chaco/bootstrap/js/bootstrap.min.js"></script>

<!-- Select2 -->
<script src="/chaco/plugins/select2/select2.full.min.js"></script>

<!-- FastClick -->
<script src="/chaco/plugins/fastclick/fastclick.min.js"></script>

<!-- AdminLTE App -->
<script src="/chaco/js/adminlte/js/app.min.js"></script>

<!-- SlimScroll 1.3.0 -->
<script src="/chaco/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script src="/chaco/plugins/iCheck/icheck.min.js"></script>
<!-- DataTables -->
<script src="/chaco/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/chaco/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/chaco/plugins/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="/chaco/plugins/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
<script src="/chaco/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<!-- notify-->
<script src="/chaco/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="/sicoe/js/adminlte/js/pages/dashboard2.js"></script>-->
<!-- AdminLTE for demo purposes -->

<script>
/*=============================================
=            sidebar-menu            =
=============================================*/


//$('.sidebar-menu').tree()
/*=============================================
=            sidebar-menu            =
=============================================*/

//Initialize Select2 Elements
    $(".select2").select2();
    //Initialize Toggle Elements
    $('.toggle').bootstrapToggle();
</script>

<script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>

<script>
    $(function() {
        $("[rel='tooltip']").tooltip();
    });
</script>

<script>
    $(function() {
        $("[data-toggle='popover']").popover();
    });
</script>

<script type='text/javascript'>
    // Botón para ir al tope de la pagina
    $(document).ready(function() {
        $("#IrArriba").hide();
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 150) {
                    $('#IrArriba').fadeIn();
                } else {
                    $('#IrArriba').fadeOut();
                }
            });
        });
        $('#arriba').click(function() {
            $('html,body').animate({scrollTop: '0px'}, 500);
            return false;
        });
    });
</script>

<script>
    function format(input)
    {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;
        } else {
            alert('Sólo se permiten numeros');
            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('[id^=detail-]').hide();
        $('.toggle').click(function() {
            $input = $(this);
            $target = $('#' + $input.attr('data-toggle'));
            $target.slideToggle();
        });
    });
</script>

<script>
    function currency(value, decimals, separators) {
        decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
        separators = separators || ['.', "'", ','];
        var number = (parseFloat(value) || 0).toFixed(decimals);
        if (number.length <= (4 + decimals))
            return number.replace('.', separators[separators.length - 1]);
        var parts = number.split(/[-.]/);
        value = parts[parts.length > 1 ? parts.length - 2 : 0];
        var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
                separators[separators.length - 1] + parts[parts.length - 1] : '');
        var start = value.length - 6;
        var idx = 0;
        while (start > -3) {
            result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
                    + separators[idx] + result;
            idx = (++idx) % 2;
            start -= 3;
        }
        return (parts.length === 3 ? '-' : '') + result;
    }


	/*=============================================
	=            DataTable            =
	=============================================*/

	$(".tablas").DataTable({
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});

</script>