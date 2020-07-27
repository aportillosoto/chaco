<?php
echo $html->css('css/overcast/jquery-ui-1.8.12.custom');
//echo $javascript->link('js/jquery-1.5.1.min');
echo $javascript->link('jquery.validate');
echo $javascript->link('js/jquery-ui-1.8.12.custom.min');
?>
<style type="text/css">
#Menu{display: none;}
            #menu {display: none;}
 #user {display: none;}

</style>


<style>
  fieldset .error {

color: red;

font: 12pt tahoma;

padding-left: 10px

    }

</style>
<script>
$(document).ready(function() {

          $("#UserCambiarpasForm").validate();

});
</script>



<div class="users form">

<?php echo $form->create('User');?>

	<fieldset>
 		<legend><?php __('Editar Password');?></legend>
	<?php
		
                echo $form->input('password', array('label'=>'Nuevo Password'));
               
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
	
		<li><?php echo $html->link(__('Inicio', true), array('action' => '../'));?></li>
	</ul>
</div>
