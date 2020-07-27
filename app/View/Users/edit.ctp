<!-- app/View/Users/add.ctp -->
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend align="center"><?php echo __('EDITAR USUARIO'); ?></legend>
        <?php 
        echo $this->Form->input('id',array('type'=>'hidden'));
        echo $this->Form->input('username');
        //echo $this->Form->input('password');
        echo $this->Form->input('usu_estado',array('type'=>'hidden','value'=>'ACTIVO'));
        echo $this->Form->input('id_funcio',array('type'=>'hidden','value'=>'0'));
        echo $this->Form->input('grupo',array('label'=>'Seleccione el grupo del usuario:','value'=>$grupos));
//        echo $this->Form->input('role', array(
//            'options' => array('admin' => 'Admin', 'author' => 'Author')
//        ));
        ?>
        <?php echo $this->Form->end(__('Guardar')); ?>
    </fieldset>
</div>
<div class="acciones">
    <ul>
        <li><?php echo $this->Html->link(__('Atrás', true), array('action' => 'index')); ?></li>
    </ul>
</div>
